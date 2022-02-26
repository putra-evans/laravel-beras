@section('script')
    <script>
        $(function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            'use strict';
            var ProdTbl = $("#ProdTbl").DataTable({
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [{
                    text: '<i class="fa fa-refresh"></i>  Reload',
                    attr: {
                        'title': 'Refresh Table',
                        'class': 'btn btn-danger mr-1',
                    },
                    action: function(e, dt, node, config) {
                        dt.ajax.reload();
                    }
                }],
                responsive: false,
                scrollX: true,
                autoWidth: false,
                ajax: "{{ route('halaman-pemesanan') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nama_penerima',
                        name: 'nama_penerima'
                    },
                    {
                        data: 'total_bayar',
                        name: 'total_bayar'
                    },
                    {
                        data: 'jasa_kirim',
                        name: 'jasa_kirim',
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status_pesanan',
                        name: 'status_pesanan'
                    },
                    {
                        data: 'no_resi',
                        name: 'no_resi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center'
                    },
                ],
                columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 2]
                    },
                    {
                        targets: 3,
                        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
                    },
                ],
            });

            // ADD DATA
            $("#addBtn").on("click", function() {
                $('#foto-produk-box').removeClass('d-block');
                $('#upload_widget_opener').html('Upload');

                $('#ProdukForm')[0].reset();
                validator.resetForm();
                var box = $(".modal-footer");
                box.empty();
                box.append(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
                    '<button id="storeProduk" type="submit" class="btn btn-primary">Simpan Produk</button>'
                );

                $("#storeProduk").on("click", function(event) {
                    event.preventDefault();
                    if ($("#ProdukForm").valid()) {
                        let fd = new FormData(document.getElementById('ProdukForm'))
                        console.log(fd)
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('simpan-produk') }}",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(data) {
                                ProdTbl.ajax.reload(null, false)
                                $('#add_produk').modal('hide');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'BERHASIL UPDATE STATUS PRODUK.'
                                })
                            },
                            error: function(err) {
                                if (err.status ==
                                    422
                                ) { // when status code is 422, it's a validation issue
                                    $('.ajax-invalid').remove();
                                    $.each(err.responseJSON.errors, function(i,
                                        error) {
                                        var el = $(document).find('[name="' +
                                            i + '"]');
                                        el.after($('<span class="ajax-invalid" style="color: red;">' +
                                            error[0] + '</span>'));
                                    });
                                } else if (err.status == 403) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'GAGAL.'
                                    })
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#detailBtn', function(e) {
                var data = ProdTbl.row($(this).parents('tr')).data();
                var id = data.id_pemesanan

                var url = "{{ route('detail-pemesanan') }}";
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        'id_pemesanan': id,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        var html = '';
                        var total_seluruh = 0;
                        $.each(response, function(index, item) {
                            total_seluruh += item.total_harga;

                            var Tharga = (item.total_harga).toLocaleString(
                                undefined, {
                                    minimumFractionDigits: 0
                                }
                            );
                            html += `
                                        <tr>
                                            <td class="text-center align-middle">${index+1}</td>
                                            <td class="text-center"><img width="100px" src="${item.foto_produk_url}" alt="IMG"></td>
                                            <td class="text-center align-middle">${item.judul_produk}</td>
                                            <td class="text-center align-middle">${item.qty}</td>
                                            <td class="text-center align-middle">Rp. ${Tharga}</td>
                                        </tr>
                            `;

                            var TOng = item.ongkir.toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, ",");


                            $("#JasaKirim").html(item.jasa_kirim);
                            $("#BeratBarang").html(item.berat_barang, 'Kg');
                            $("#Ongkir").html('Rp. ' + TOng);
                            $("#Estimasi").html(item.estimasi);

                            $("#NamaPenerima").html(item.nama_penerima);
                            $("#NoHP").html(item.no_hp_penerima);
                            $("#Alamat").html(item.alamat_penerima);

                            $("#ProvTujuan").html(item.nama_prov);
                            $("#KotaTujuan").html(item.title);

                            var TBayar = item.total_bayar.toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, ",");
                            $("#TotalB").html('Rp. ' + TBayar);
                        });
                        var box = $(".DetailPesanan");
                        box.empty();
                        box.append(html);
                    }
                });
            });

            $(document).on('click', '#BuktiPembayaran', function(e) {
                $('#update_status').prop('selectedIndex', 0);
                $("#StatusForm")[0].reset();

                var data = ProdTbl.row($(this).parents('tr')).data();
                console.log(data)
                var id = data.id_pemesanan

                var url = "{{ route('get-file') }}";
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        'id_pemesanan': id,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        // var img = response[0].file_upload;
                        // var lihat = response[0].file_upload;
                        var source = "{!! url('/img') !!}" + '/' + response[0].file_upload;
                        $('#BuktiP').attr("src", source);
                        $('#LihatP').attr("href", source);
                        $('#id_pemesanan').val(id);
                    }
                });

                $("#storeStatus").on("click", function(event) {
                    event.preventDefault();
                    let fd = new FormData(document.getElementById('StatusForm'))
                    console.log(fd)
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('update-status') }}",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            ProdTbl.ajax.reload(null, false)
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                            $('#bukti_pembayaran').modal('hide');
                            Toast.fire({
                                icon: 'success',
                                title: 'BERHASIL UPDATE PESANAN.'
                            })
                        },
                        error: function(err) {
                            if (err.status ==
                                422
                            ) { // when status code is 422, it's a validation issue
                                $('.ajax-invalid').remove();
                                $.each(err.responseJSON.errors, function(i,
                                    error) {
                                    var el = $(document).find('[name="' +
                                        i + '"]');
                                    el.after($('<span class="ajax-invalid" style="color: red;">' +
                                        error[0] + '</span>'));
                                });
                            } else if (err.status == 403) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'GAGAL.'
                                })
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
