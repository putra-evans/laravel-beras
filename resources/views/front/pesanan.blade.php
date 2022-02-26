@extends('front.index')
@section('contents')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Pesanan Saya
            </span>
        </div>
    </div>
    <!-- Shoping Cart -->
    <form class="bg0 p-t-75 p-b-85" id="transaksiform" autocomplete="off">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <table class="table table-bordered">
                        <tr class="table_head text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Jasa Pengiriman</th>
                            <th>Total Bayar</th>
                            <th>Status Pesanan</th>
                            <th>No Resi</th>
                            <th>Aksi</th>
                        </tr>
                        <tbody class="DetailCheckout">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
    <br><br><br><br><br><br><br><br>
    {{-- MODAL DETAILS --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container">
                    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 p-b-30">
                                <div class="p-l-25 p-r-30 p-lr-0-lg">
                                    <h4>Data Penerima :</h4>
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="NamaPenerima"></td>
                                        </tr>
                                        <tr>
                                            <td>No Hp</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="NoHP"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="Alamat"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 p-b-30">
                                <div class="p-l-25 p-r-30 p-lr-0-lg">
                                    <h4>Data Tujuan :</h4>
                                    <table>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="ProvTujuan"></td>
                                        </tr>
                                        <tr>
                                            <td>Kab/Kota</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="KotaTujuan"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 p-b-30">
                                <div class="p-l-25 p-r-30 p-lr-0-lg">
                                    <h4>Data Pengiriman :</h4>
                                    <table>
                                        <tr>
                                            <td>Jasa Kirim</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="JasaKirim"></td>
                                        </tr>
                                        <tr>
                                            <td>Berat Barang</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="BeratBarang"></td>
                                        </tr>
                                        <tr>
                                            <td>Ongkos Kirim</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="Ongkir"></td>
                                        </tr>
                                        <tr>
                                            <td>Estimasi</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td style="font-weight: bold" id="Estimasi"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <h5 class="mt-4">Total Bayar :</h5>
                            <div class="bg-gray py-2 px-3">
                                <h2 class="mb-0" id="TotalB">
                                </h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="container">
                                <h4>Data Produk :</h4>
                                <table class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="30%">Foto Produk</th>
                                            <th width="30%">Nama Produk</th>
                                            <th width="5%">Qty</th>
                                            <th width="30%">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="Details">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL UPLOAD BUKTI PEMBAYARAN --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                </div>
                <form method="post" enctype="multipart/form-data" id="UploadForm">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_pemesanan" id="id_pemesanan" value="">
                    <div class="modal-body">
                        <input type="file" name="file_bukti" id="file_bukti" class="form-control">
                        {{-- <div id="foto-produk-box" class="product-img d-none mb-2 text-center">
                            <img class="img-fluid" id="foto-produk-src" src="" alt="" width="50%">
                        </div>
                        <br>
                        <button id="upload_widget_opener" type="button" class="btn btn-info btn-sm">Upload</button>
                        <input type="hidden" id="foto_upload" name="foto_upload" value="null"> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary StoreUpload">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- KONFIRMASI SELESAI --}}
    <div class="modal fade" id="KonfSelesai" tabindex="-1" role="dialog" aria-labelledby="KonfSelesaiLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="KonfSelesaiLabel">Konfirmasi Pesanan Diterima</h5>
                </div>
                <form method="post" enctype="multipart/form-data" id="KonfirmasiForm">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_pemesanan_konf" id="id_pemesanan_konf" value="">
                    <div class="modal-body">
                        <span style="font-size: 12px;">Pastikan anda sudah menerima pesanan anda, dan aksi ini tidak dapat
                            dibatalkan! </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary StoreKonfirmasi">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        'use strict';
        $(document).ready(function() {
            PesananSaya()

            // UPLOAD BUKTI BAYAR
            // var myWidget = cloudinary.createUploadWidget({
            //     cloudName: 'poakboco',
            //     uploadPreset: 'dq6pumxf',
            //     folder: 'jual_beras',
            //     theme: 'minimal',
            //     multiple: false,
            //     max_file_size: 10048576,
            //     background: "black",
            //     height: 250,
            //     width: 250,
            //     crop: "pad"
            // }, (error, result) => {
            //     if (!error && result && result.event === "success") {
            //         console.log('Done! Here is the image info: ', result.info);

            //         var secure_url = result.info.secure_url;
            //         console.log(secure_url);
            //         $('input[name=foto_produk_temp]').val(secure_url);
            //         $('input[name=foto_upload]').val(secure_url);

            //         $('#foto-produk-box').addClass('d-block');
            //         $('#foto-produk-box').removeClass('d-none');
            //         $('#tu-upload-box').hide();

            //         $('#foto-produk-src').attr("src", secure_url)
            //         $('#foto-produk-url').attr("href", secure_url)
            //     }
            // })
            // document.getElementById("upload_widget_opener").addEventListener("click", function () {
            //     myWidget.open();
            // }, false);
        });

        function PesananSaya() {
            var url = "{{ route('view-myorder') }}";
            var user_id = $('#user_id').val();
            if (user_id != '') {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id_user': user_id,
                    },
                    dataType: "json",
                    success: function(response) {
                        var html = '';
                        var total_seluruh = 0;
                        $.each(response, function(index, item) {
                            var a = item.total_bayar;
                            var status = item.status_pesanan;
                            var output = (a / 1000).toFixed(3);

                            var resi = item.no_resi;
                            if (resi == null) {
                                var resi_asli = '<span class="text-danger">Belum ada no resi</span>';
                            } else {
                                var resi_asli =
                                    `<span class="font-weight-bold font-italic">${item.no_resi}</span>`;
                            }

                            if (status === 'Menunggu Pembayaran') {
                                var btn = `<button type="button" class="btn btn-primary btn-sm BtnUpload" data-id="${item.id_pemesanan}" data-toggle="modal" data-target="#exampleModal">
                                        Upload Bukti Pembayaran
                            </button>`;
                            } else {
                                var btn = ``;
                            }

                            if (status === 'Pesanan Dikirim') {
                                var btnTerima = `<button type="button" class="btn btn-success btn-sm BtnTerima" data-id="${item.id_pemesanan}" data-toggle="modal" data-target="#KonfSelesai">
                                        Pesanan Diterima
                            </button>`;
                            } else {
                                var btnTerima = ``;
                            }

                            if (status === 'Menunggu Pembayaran') {
                                var pesan_status =
                                    '<span class="badge badge-primary">Menunggu Pembayaran</span>'
                            } else if (status === 'Pembayaran Diterima') {
                                var pesan_status =
                                    '<span class="badge badge-success">Pembayaran Diterima</span>'
                            } else if (status === 'Pesanan Dikirim') {
                                var pesan_status = '<span class="badge badge-info">Dikirim</span>'
                            } else if (status === 'Pembayaran Ditolak') {
                                var pesan_status =
                                    '<span class="badge badge-danger">Pembayaran Ditolak</span>'
                            } else if (status === 'Menyiapkan Pesanan') {
                                var pesan_status =
                                    '<span class="badge badge-secondary">Menyiapkan Pesanan</span>'
                            } else if (status === 'Cek Pembayaran') {
                                var pesan_status =
                                    '<span class="badge badge-warning">Cek Pembayaran</span>'
                            } else if (status === 'Selesai') {
                                var pesan_status =
                                    '<span class="badge badge-success">Selesai</span>'
                            } else {
                                var pesan_status = '<span class="badge badge-danger">Dibatalkan</span>'
                            }

                            html += `
                                <tr class="table_row">
                                    <td class="text-center">
                                        ${index + 1}
                                    </td>
                                    <td> ${item.nama_penerima}</td>
                                    <td>${item.no_hp_penerima} </td>
                                    <td class="text-center">${item.jasa_kirim} </td>
                                    <td class="text-center">Rp. ${output} </td>
                                    <td class="text-center">${pesan_status}</td>
                                    <td class="text-center">${resi_asli}</td>
                                    <td class="text-center">
                                        ${btn}
                                        ${btnTerima}
                                        <button type="button" class="btn btn-warning btn-sm BtnDetail"  data-id="${item.id_pemesanan}" data-toggle="modal" data-target=".bd-example-modal-lg">
                                        Detail Pesanan
                                        </button>
                                    </td>s
                                </tr>
                            `;
                        });
                        var box = $(".DetailCheckout");
                        box.empty();
                        box.append(html);
                    }
                });
            } else {
                swal(nameProduct, "Gagal", "errors");
            }
        }

        $(document).on('click', '.BtnDetail', function(e) {
            var id = $(this).data('id');
            console.log(id)

            var url = "{{ route('view-detail') }}";
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

                        var TOng = item.ongkir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


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
                    var box = $(".Details");
                    box.empty();
                    box.append(html);
                }
            });
        });


        $(document).on('click', '.BtnUpload', function(e) {
            $("#UploadForm")[0].reset()
            // $('#foto-produk-src').attr('src', '');
            // $('#foto-produk-box').removeClass('d-block');
            // $('#upload_widget_opener').html('Upload');
            var id = $(this).data('id');
            $('#id_pemesanan').val(id);
            var url = "{{ route('upload-bayar') }}";
            $(".StoreUpload").on("click", function(event) {
                event.preventDefault();
                var fotoupload = $('#file_bukti').val();
                if (fotoupload != '') {
                    let fd = new FormData(document.getElementById('UploadForm'))
                    console.log(fd)
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            PesananSaya()
                            swal('Upload', "Berhasil Upload", "success");
                        },
                        error: function(err) {
                            alert('Gagal Upload')
                        }
                    });
                } else {
                    alert('Silahkan Upload Bukti Terlebih Dahulu')
                }
            });
        });

        $(document).on('click', '.BtnTerima', function(e) {
            var id = $(this).data('id');
            $('#id_pemesanan_konf').val(id);
            var url = "{{ route('konfirmasi-pesanan') }}";
            $(".StoreKonfirmasi").on("click", function(event) {
                event.preventDefault();
                let fd = new FormData(document.getElementById('KonfirmasiForm'))
                console.log(fd)
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        PesananSaya()
                        swal('Konfirmasi Pesanan', "Berhasil", "success");
                    },
                    error: function(err) {
                        alert('Gagal')
                    }
                });
            });
        });
    </script>
@endsection
