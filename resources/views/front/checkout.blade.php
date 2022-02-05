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
            Checkout
        </span>
    </div>
</div>
<!-- Shoping Cart -->

<form class="bg0 p-t-75 p-b-85" id="transaksiform" autocomplete="off">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Foto</th>
                                <th class="column-1">Produk</th>
                                <th class="column-1">Harga</th>
                                <th class="column-1">Qty</th>
                                <th class="column-5">Total</th>
                            </tr>

                            <tbody class="DetailCheckout">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class=" p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">
                                Masukkan Data Dengan Benar :
                            </p>

                            <div class="p-t-10">
                                <span class="stext-112 cl8">
                                    Data Penerima
                                </span>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="HiddenTotal" id="HiddenTotal"
                                    class="form-control HiddenTotal">
                                <input type="hidden" name="TBayar" id="TBayar" class="form-control TBayar">
                                <input type="hidden" name="jasaKirim" id="jasaKirim" class="form-control jasaKirim">
                                <input type="hidden" name="HargaOngkir" id="HargaOngkir"
                                    class="form-control HargaOngkir">
                                <input type="hidden" name="Estimasi" id="Estimasi" class="form-control Estimasi">
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 form-group">
                                    <label for="NamaCust">Nama Penerima</label>
                                    <input type="text" name="NamaCust" id="NamaCust" class="form-control" required>
                                </div>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 form-group">
                                    <label for="HpCust">NoHp Penerima</label>
                                    <input type="text" name="HpCust" id="HpCust" class="form-control" required>
                                </div>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 form-group">
                                    <label for="AlamatCust">Alamat Lengkap</label>
                                    <textarea name="AlamatCust" id="AlamatCust" cols="30" rows="5" required></textarea>
                                </div>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 form-group">
                                    <label for="province_destination">Provinsi Tujuan</label>
                                    <select class="form-control" name="province_destination" required>
                                        <option> -- Pilih Provinsi -- </option>
                                        @foreach ($provinces as $province =>$value )
                                        <option value="{{$province}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="bor8 bg0 m-b-12 form-group">
                                    <label for="city_destination">Kota Asal</label>
                                    <select class="form-control" name="city_destination" id="city_destination" required>
                                        <option> -- Pilih Kota -- </option>
                                    </select>
                                </div>


                                <div class="bor8 bg0 m-b-12 form-group">
                                    <label for="weight">Berat (g)</label>
                                    <input type="number" name="weight" id="weight" class="form-control" value="5000"
                                        required>
                                </div>

                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 form-group">
                                    <label for="courier">Kurir</label>
                                    <select class="form-control" name="courier" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($couriers as $couriers =>$value )
                                        <option value="{{$couriers}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <button class="btn btn-md btn-primary btn-block btn-check">CEK ONGKOS
                                        KIRIM</button>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="card d-none ongkir">
                                            <div class="card-body">
                                                <ul class="list-group" id="ongkir"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <table>
                        <tr>
                            <td class="mtext-101 cl2">Ongkir</td>
                            <td>&emsp;:&emsp;</td>
                            <td><span class="mtext-101 cl2 OngkosKirim">
                                    0
                                </span></td>
                        </tr>
                        <tr>
                            <td class="mtext-101 cl2">Total</td>
                            <td>&emsp;:&emsp;</td>
                            <td><span class="mtext-101 cl2 TotalAkhir">
                                    0
                                </span></td>
                        </tr>
                        <tr>
                            <td class="mtext-101 cl2">Total Akhir</td>
                            <td>&emsp;:&emsp;</td>
                            <td><span class="mtext-101 cl2 TotalA">
                                    0
                                </span></td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit"
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer storePemesanan">
                        Proses Checkout
                    </button>
                </div>
            </div>
        </div>
</form>

@endsection
@section('script')
<script>
    'use strict';
    $(document).ready(function () {
        ListKeranjang()
        $('select[name="province_destination"]').on('change', function () {
            var url = "{{ route('get-cities') }}";
            let provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        'id': provinceId
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        $('select[name="city_destination"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="city_destination"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="city_destination"]').empty();
            }
        });

        let isProcessing = false;
        $('.btn-check').click(function (e) {
            e.preventDefault();
            var url = "{{ route('get-ongkir') }}";

            let city_origin = $('select[name=city_origin]').val();
            let city_destination = $('select[name=city_destination]').val();
            let courier = $('select[name=courier]').val();
            let weight = $('#weight').val();
            console.log(city_destination);
            console.log(courier);

            if ((city_destination == '-- Pilih Kota --')) {
                alert('Silahkan Pilih Provinsi, Kota dan Kurir')
            } else {

                isProcessing = true;
                jQuery.ajax({
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        city_origin: city_origin,
                        city_destination: city_destination,
                        courier: courier,
                        weight: weight,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function (response) {
                        isProcessing = false;
                        if (response) {

                            $('#ongkir').empty();
                            $('.ongkir').addClass('d-block');
                            $.each(response[0]['costs'], function (key, value) {
                                $('#ongkir').append(
                                    `<li class="list-group-item"> <input data-service="${response[0].code.toUpperCase()}" data-harga="${value.cost[0].value}" data-etd="${value.cost[0].etd}" type="radio" name="service" value="${response[0].code.toUpperCase()}"/> ${response[0].code.toUpperCase()}  : <strong> ${value.service} </strong> - Rp.  ${value.cost[0].value}  (${value.cost[0].etd} hari)</li>`
                                )
                            });
                            $('input:radio[name="service"]').on('click', function () {
                                if ($(this).prop('checked', true)) {
                                    var jasa = $(this).attr('data-service');
                                    var harga = $(this).attr('data-harga');
                                    var etd = $(this).attr('data-etd');
                                    var aharga_ongkir = (harga).toLocaleString(
                                        undefined, {
                                            minimumFractionDigits: 2
                                        }
                                    );
                                    var a = $(".HiddenTotal").val();
                                    $(".jasaKirim").val(jasa);
                                    $(".HargaOngkir").val(harga);
                                    $(".Estimasi").val(etd);
                                    var b = parseInt(harga) + parseInt(a);
                                    var bharga = (b).toLocaleString(
                                        undefined, {
                                            minimumFractionDigits: 0
                                        }
                                    );
                                    $(".OngkosKirim").html('Rp. ' + aharga_ongkir);
                                    $(".TotalA").html('Rp. ' + bharga);
                                    $(".TBayar").val(b);

                                }
                            });
                        }
                    },
                    error: function () {
                        alert('Kurir Wajib Isi dan Dipilih');
                    }
                });
            }
        });
    });

    var validator = $('#transaksiform').validate({
        ignore: [],
        rules: {
            NamaCust: {
                required: true,
            },
            HpCust: {
                required: true,
            },
            AlamatCust: {
                required: true,
            },
            city_destination: {
                required: true,
            },

        },
        messages: {
            NamaCust: {
                required: "Nama Tidak Boleh Kosong"
            },
            HpCust: {
                required: "No HP Tidak Boleh Kosong"
            },
            AlamatCust: {
                required: "Alamat Tidak Boleh Kosong"
            },
            city_destination: {
                required: "Provinsi Tujuan Tidak Boleh Kosong"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $(".storePemesanan").on("click", function (event) {
        event.preventDefault();
        if ($("#transaksiform").valid()) {
            let fd = new FormData(document.getElementById('transaksiform'))
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{ route('save-pemesanan') }}",
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    swal("Pemesanan", "Berhasil Checkout", "success");
                    window.location.href = "{{ route('my-order')}}";
                },
                error: function (err) {
                    alert("Error");
                }
            });
        }
    });

    function ListKeranjang() {
        var url = "{{ route('view-cart') }}";
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
                success: function (response) {
                    var html = '';
                    var total_seluruh = 0;
                    $.each(response, function (index, item) {
                        total_seluruh += item.total_harga;

                        var harga = (item.harga_produk).toLocaleString(
                            undefined, {
                                minimumFractionDigits: 0
                            }
                        );
                        var Tharga = (item.total_harga).toLocaleString(
                            undefined, {
                                minimumFractionDigits: 0
                            }
                        );
                        html += `
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="${item.foto_produk_url}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">${item.judul_produk}</td>
                                    <td class="column-3">Rp. ${harga}</td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m BtnKurang"
                                            data-id_keranjang="${item.id_keranjang}"
                                            data-id_produk="${item.id_produk}"
                                            data-id_user="${item.id_user}"
                                            data-qty="${item.qty}"
                                            data-harga="${item.harga_produk}"
                                            data-total_harga="${item.total_harga}">
                                                <i class="fs-16 zmdi zmdi-minus "></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="qty" value="${item.qty}">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m BtnPlus"  data-id_keranjang="${item.id_keranjang}"
                                            data-id_produk="${item.id_produk}"
                                            data-id_user="${item.id_user}"
                                            data-qty="${item.qty}"
                                            data-harga="${item.harga_produk}"
                                            data-total_harga="${item.total_harga}">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5">Rp. ${Tharga}</td>
                                </tr>
                            `;
                    });
                    var TotalS = (total_seluruh).toLocaleString(
                        undefined, {
                            minimumFractionDigits: 0
                        }
                    );
                    $(".TotalAkhir").html('Rp. ' + TotalS);
                    $("#HiddenTotal").val(total_seluruh);


                    var box = $(".DetailCheckout");
                    box.empty();
                    box.append(html);

                    // UNTUK TAMBAH STOK PRODUK
                    $(".BtnPlus").on("click", function (event) {
                        let id_keranjang = $(this).data('id_keranjang');
                        let id_produk = $(this).data('id_produk');
                        let id_user = $(this).data('id_user');
                        let qty = $(this).data('qty');
                        let harga = $(this).data('harga');
                        let total_harga = $(this).data('total_harga');
                            $.ajax({
                                type: 'GET',
                                url: "{{ route('tambah-produk') }}",
                                data: {
                                    'id_keranjang' : id_keranjang,
                                    'id_produk' : id_produk,
                                    'id_user' : id_user,
                                    'qty' : qty,
                                    'harga' : harga,
                                    'total_harga' : total_harga,
                                },
                                dataType: 'json',
                                success: function (data) {
                                    swal("Pemesanan", "Berhasil Tambah Produk", "success");
                                    window.location.reload();
                                },
                                error: function (err) {
                                    alert("Error");
                                }
                            });
                    });
                    // UNTUK KURANG STOK PRODUK
                    $(".BtnKurang").on("click", function (event) {
                        let id_keranjang = $(this).data('id_keranjang');
                        let id_produk = $(this).data('id_produk');
                        let id_user = $(this).data('id_user');
                        let qty = $(this).data('qty');
                        let harga = $(this).data('harga');
                        let total_harga = $(this).data('total_harga');
                            $.ajax({
                                type: 'GET',
                                url: "{{ route('kurang-produk') }}",
                                data: {
                                    'id_keranjang' : id_keranjang,
                                    'id_produk' : id_produk,
                                    'id_user' : id_user,
                                    'qty' : qty,
                                    'harga' : harga,
                                    'total_harga' : total_harga,
                                },
                                dataType: 'json',
                                success: function (data) {
                                    swal("Pemesanan", "Berhasil Kurangi Produk", "success");
                                    window.location.reload();
                                },
                                error: function (err) {
                                    alert("Error");
                                }
                            });
                    });


                }
            });
        } else {
            swal(nameProduct, "Gagal", "errors");
        }


    }

</script>
@endsection
