@section('script')
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
    <script>
        $(function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            var myWidget = window.cloudinary.createUploadWidget({
                cloudName: 'poakboco',
                uploadPreset: 'dq6pumxf',
                folder: 'jual_beras',
                theme: 'minimal',
                multiple: false,
                max_file_size: 10048576,
                background: "black",
                height: 250,
                width: 250,
                crop: "pad"
            }, (error, result) => {
                if (!error && result && result.event === "success") {
                    console.log('Done! Here is the image info: ', result.info);

                    var secure_url = result.info.secure_url;
                    console.log(secure_url);
                    $('input[name=foto_produk_temp]').val(secure_url);
                    $('input[name=foto_produk_url]').val(secure_url);

                    $('#foto-produk-box').addClass('d-block');
                    $('#foto-produk-box').removeClass('d-none');
                    $('#tu-upload-box').hide();

                    $('#foto-produk-src').attr("src", secure_url)
                    $('#foto-produk-url').attr("href", secure_url)
                }
            })

            document.getElementById("upload_widget_opener").addEventListener("click", function() {
                myWidget.open();
            }, false);


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
                buttons: [
                    // 'pageLength',
                    {
                        text: '<i class="fa fa-plus-circle"></i> Add Data',
                        attr: {
                            'title': 'Entry New Data',
                            'data-bs-original-title': 'Entry New Data',
                            'data-toggle': 'modal',
                            'data-target': '#add_produk',
                            'type': 'button',
                            'id': 'addBtn',
                            'class': 'btn btn-primary mr-1 ml-1'
                        },
                        action: function(e, dt, node, config) {
                            // alert('Button activated');
                        }
                    },
                    {
                        text: '<i class="fa fa-refresh"></i>  Reload',
                        attr: {
                            'title': 'Refresh Table',
                            'class': 'btn btn-danger mr-1',
                        },
                        action: function(e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    }
                ],
                responsive: false,
                scrollX: true,
                autoWidth: false,
                ajax: "{{ route('halaman-produk') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'kategori.nama_kategori',
                        name: 'kategori.nama_kategori'
                    },
                    {
                        data: 'judul_produk',
                        name: 'judul_produk'
                    },
                    {
                        data: 'merk_produk',
                        name: 'merk_produk'
                    },
                    {
                        data: 'tahun_pembuatan_produk',
                        name: 'tahun_pembuatan_produk',
                        className: 'text-center'
                    },
                    {
                        data: 'harga_produk',
                        name: 'harga_produk'
                    },
                    {
                        data: 'persediaan_awal',
                        name: 'persediaan_awal',
                        className: 'text-center'

                    },
                    {
                        data: 'persediaan_sisa',
                        name: 'persediaan_sisa',
                        className: 'text-center'

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
                        targets: 5,
                        render: $.fn.dataTable.render.number(',', '.', 2, 'Rp. ')
                    },
                    {
                        targets: 6,
                        render: $.fn.dataTable.render.number(',', '.', 0, '', ' Kg')
                    },
                    {
                        targets: 7,
                        render: $.fn.dataTable.render.number(',', '.', 0, '', ' Kg')
                    }
                ],
            });

            // VALIDASI FORM
            var validator = $('#ProdukForm').validate({
                ignore: [],
                rules: {
                    judul_produk: {
                        required: true,
                    },
                    deskripsi_produk: {
                        required: true,
                    },
                    merk_produk: {
                        required: true,
                    },
                    id_kategori: {
                        required: true,
                    },
                    tahun_pembuatan_produk: {
                        required: true,
                    },
                    harga_produk: {
                        required: true,
                    },
                    stok_produk: {
                        required: true,
                    },
                    foto_produk_url: {
                        required: true,
                    }
                },
                messages: {
                    judul_produk: {
                        required: "Judul Produk Tidak Boleh Kosong"
                    },
                    deskripsi_produk: {
                        required: "Deskripsi Produk Tidak Boleh Kosong"
                    },
                    merk_produk: {
                        required: "Merk Produk Tidak Boleh Kosong"
                    },
                    id_kategori: {
                        required: "Jenis Beras Tidak Boleh Kosong"
                    },
                    tahun_pembuatan_produk: {
                        required: "Tahun Produk Tidak Boleh Kosong"
                    },
                    harga_produk: {
                        required: "Harga Produk Tidak Boleh Kosong"
                    },
                    stok_produk: {
                        required: "Stok Produk Tidak Boleh Kosong"
                    },
                    foto_produk_url: {
                        required: "Foto Produk Tidak Boleh Kosong"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
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
                        // var formdata = $("#ProdukForm").serialize()
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
                                    title: 'BERHASIL INSERT DATA PRODUK.'
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

            // DELETE DATA
            $(document).on('click', '#deleteBtn', function(e) {
                var data = ProdTbl.row($(this).parents('tr')).data();
                swalWithBootstrapButtons.fire({
                    title: 'Apakah ingin menghapus ' + data.judul_produk + '?',
                    text: "Aksi ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Tidak, Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formdata = $("#ProdTbl").serialize();
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('hapus-produk') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": data.id_produk,
                            },

                            dataType: 'json', // let's set the expected response format
                            success: function(data) {
                                if (data.success) {
                                    $('#add_produk').modal('hide');
                                    ProdTbl.ajax.reload(null, false);
                                    swalWithBootstrapButtons.fire(
                                        'Terhapus!',
                                        'Data Berhasil Dihapus.',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(err) {
                                if (err.status == 422) {
                                    $('.ajax-invalid').remove();
                                    $.each(err.responseJSON.errors, function(i,
                                        error) {
                                        var el = $(document).find('[name="' +
                                            i + '"]');
                                        el.after($('<span class="ajax-invalid" style="color: red;">' +
                                            error[0] + '</span>'));
                                    });
                                } else if (err.status == 403) {
                                    Swal.fire(
                                        'Unauthorized!',
                                        'You are unauthorized to do the action',
                                        'warning'
                                    );
                                }
                            }
                        });
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Dibatalkan',
                        )
                    }
                });
            });

            // EDIT DATA
            $(document).on('click', '#editBtn', function(e) {
                $('#ProdukForm')[0].reset();
                validator.resetForm();
                $('#foto-produk-box').addClass('d-block');
                $('#upload_widget_opener').html('Upload Ulang');

                $(".modal-title").html('Edit Produk Beras');
                var box = $(".modal-footer");
                box.empty();
                box.append(
                    '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' +
                    '<button id="updateItem" type="submit" class="btn btn-primary">Update</button>');
                var data = ProdTbl.row($(this).parents('tr')).data();

                // TAMPIL DATA DI FORM EDIT
                $('#id_produk').val(data.id_produk);
                $('#judul_produk').val(data.judul_produk);
                $('#deskripsi_produk').val(data.deskripsi_produk);
                $('#merk_produk').val(data.merk_produk);
                $('#id_kategori').val(data.id_kategori).trigger("change");
                $('#tahun_pembuatan_produk').val(data.tahun_pembuatan_produk);
                $('#harga_produk').val(data.harga_produk);
                $('#persediaan_awal').val(data.persediaan_awal);
                $('#persediaan_sisa').val(data.persediaan_sisa);

                $('#foto_produk_url').val(data.foto_produk_url);
                $('#foto-produk-src').attr("src", data.foto_produk_url);


                $("#updateItem").on("click", function(event) {
                    event.preventDefault();

                    if ($("#ProdukForm").valid()) {
                        var formdata = $("#ProdukForm").serialize();
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('update-produk') }}",
                            data: formdata,
                            dataType: 'json',
                            success: function(data) {
                                if (data.success) {
                                    $('#add_produk').modal('hide');
                                    ProdTbl.ajax.reload(null, false);
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'BERHASIL EDIT DATA PRODUK BERAS.'
                                    })
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'GAGAL.'
                                    })
                                }
                            },
                            error: function(err) {
                                if (err.status == 422) {
                                    $('.ajax-invalid').remove();
                                    $.each(err.responseJSON.errors, function(i,
                                        error) {
                                        var el = $(document).find('[name="' +
                                            i + '"]');
                                        el.after($('<span class="ajax-invalid" style="color: red;">' +
                                            error[0] + '</span>'));
                                    });
                                } else if (err.status == 403) {
                                    Swal.fire(
                                        'Unauthorized!',
                                        'You are unauthorized to do the action',
                                        'warning'
                                    );
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#detailBtn', function(e) {
                var data = ProdTbl.row($(this).parents('tr')).data();
                console.log('preview-produk');
                console.log(data);
                $('#detailProdukImg').attr("src", data.foto_produk_url);
                var harga = (data.harga_produk).toLocaleString(
                    undefined, {
                        minimumFractionDigits: 2
                    }
                );
                $('#JudulProduk').html(data.judul_produk);
                $('#MerkProduk').html(data.merk_produk);
                $('.DeskripsiProduk').html(data.deskripsi_produk);
                $('#JenisBeras').html(data.kategori.nama_kategori);
                $('#tahunProduksi').html(data.tahun_pembuatan_produk);
                $('#PersediaanAwal').html(data.persediaan_awal + ' Kg');
                $('#SisaPersediaan').html(data.persediaan_sisa + ' Kg');
                $('#HargaProduk').html('Rp. ' + harga + ' /Kg');
            });


            // ONCHANGE KATEGORI
            $(document).on('change', 'select[name="city_id"]', function(e) {
                let id = $(this).val();
                getJenisBeras(id);
            });

            // Get Fasilitas
            function getJenisBeras(id) {
                let lblReg = '';
                $.ajax({
                    type: 'GET',
                    url: "{{ route('get-jenis-beras') }}",
                    data: {
                        'jenis': id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.status)
                        $('select[name="id_kategori"]').html('');
                        if (data.status == '200') {
                            $('#id_kategori').removeAttr('disabled');
                            lblReg = '<option value="">Pilih Jenis</option>';
                            $.each(data.data, function(key, value) {
                                lblReg += '<option value="' + value['id_kategori'] + '">' +
                                    value['nama_kategori'] + '</option>';
                            });
                        } else
                            lblReg = '<option value="">Pilih Jenis</option>';
                        $('select[name="id_kategori"]').html(lblReg);
                    }
                });
            }


        });
    </script>
@endsection
