@extends('front.index')
@section('contents')
<div class="container">
    <div class="p-b-10">
        <h3 class="ltext-103 cl5">
            Kategori
        </h3>
    </div>

    <div class="flex-w flex-sb-m p-b-52">
        <form id="filter-form">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                @foreach($kategori as $pecah)
                <label class="  " for="chk-ani">
                    <input type="checkbox" class="form-control" name="id_kategori[]"
                        value="{{$pecah->id_kategori}}"> {{$pecah->nama_kategori}}
                </label>
                &emsp;&emsp;&emsp;
                @endforeach
            </div>
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-primary" id="save-filter-btn">Terapkan</button>
            </div>
        </form>
    </div>
    <div class="p-b-10">
        <h3 class="ltext-103 cl5">
            Produk Beras
        </h3>
    </div>
    <div class="row isotope-grid itemList">

    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                                <div class="wrap-pic-w pos-relative">
                                    <img src="" id="IMGProduk" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                        href="" id="Show_Img" target="_blank">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_produk" id="id_produk">
                            <input type="hidden" name="hargaProd" id="hargaProd">
                            {{-- <input type="hidden" name="UserId" id="UserId" value="{{Auth::user()->id}}"> --}}
                            <input type="hidden" name="UserId" id="UserId" value="{{ Auth::check() ? Auth::user()->id : '' }}">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14" id="Nama_Produk">
                            </h4>

                            <span id="Harga_Produk" class="mtext-106 cl2">
                            </span>

                            <p class="stext-102 cl3 p-t-23 text-justify" id="Deskripsi_Produk">
                            </p>

                            <p class="stext-102 cl3 p-t-18 text-justify" id="Persediaan_Awal">
                            </p>

                            <p class="stext-102 cl3 p-t-18 text-justify" id="Sisa_Persediaan">
                            </p>
                            <p class="stext-102 cl3 p-t-18 text-justify" id="Tahun_Produk">
                            </p>

                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        @if (Auth::user()!= '')
                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 AddCart">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @else
                            <h6 class="pt-2 text-danger text-center">Login / Register Sebelum Membeli
                            </h6>
                            <a href="{{ route('login') }}" class="btn btn-primary ml-1">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
    'use strict';
     $(document).ready(function () {
        DataProduk();
        totalkeranjang()
    });

    function DataProduk(params) {
        var url = "{{ route('product.all') }}";
        var formdata = $("#filter-form").serialize();
        $.ajax({
            type: "POST",
            url: url,
            data:formdata,
            success: function (data) {
                var html = '';
                $.each(data.data, function(index, item){
                    var harga = (item.harga_produk).toLocaleString(
                        undefined,
                        { minimumFractionDigits: 0 }
                        );
                    html += `
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <div class="card">
                    <div class="card-body">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="${item.foto_produk_url}" alt="IMG-PRODUCT">
                                <button type="button" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 BtnDetail"
                                data-id="${item.id_produk}"
                                data-judul="${item.judul_produk}"
                                data-deskripsi="${item.deskripsi_produk}"
                                data-merk="${item.merk_produk}"
                                data-tahun="${item.tahun_pembuatan_produk}"
                                data-foto="${item.foto_produk_url}"
                                data-harga="${item.harga_produk}"
                                data-awal="${item.persediaan_awal}"
                                data-sisa="${item.persediaan_sisa}"
                                data-toggle="modal" data-target=".bd-example-modal-lg">Detail Produk</button>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="#"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        ${item.judul_produk}
                                    </a>

                                    <span class="stext-105 cl3">
                                        Rp. ${harga}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                `;
                });
                var box = $(".itemList");
                box.empty();
                box.append(html);

                var footer = `<div class="col-xl-12 col-sm-12 xl-12 pb-4">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end pagination-primary">`

                $.each(data.links, function (index, item) {

                    if (index == 0) {
                        footer +=
                            `<li class="page-item ${data.current_page == 1 ? 'disabled' : ''} "><button class="page-link" data-selfuri="${item.url}" href="javascript:void(0)" data-bs-original-title="" title="">${item.label}</button></li>`;
                    }

                    if (index == (data.last_page + 1)) {
                        footer +=
                            `<li class="page-item ${data.current_page == data.last_page ? 'disabled' : ''} "><button class="page-link" data-selfuri="${item.url}" href="javascript:void(0)" data-bs-original-title="" title="">${item.label}</button></li>`;
                    }


                    if (index > (data.current_page - 3) && index < (data.current_page +
                            3) && index != 0 && index != (data.last_page + 1)) {
                        footer +=
                            `<li class="page-item ${item.active ? 'active' : ''} "><button class="page-link" data-selfuri="${item.url}" href="javascript:void(0)" data-bs-original-title="" title="">${item.label}</button></li>`;
                    }

                });
                footer += `       </ul>
                 </nav>
              </div>`;
                box.append(footer);
            }
        });

        $(document).on('click', '.BtnDetail', function(e) {
        var id = $(this).data('id');
        var judul = $(this).data('judul');
        var deskripsi = $(this).data('deskripsi');
        var merk = $(this).data('merk');
        var tahun = $(this).data('tahun');
        var foto = $(this).data('foto');
        var harga = $(this).data('harga');
        var awal = $(this).data('awal');
        var sisa = $(this).data('sisa');

        var harga_produk = (harga).toLocaleString(
            undefined,
            { minimumFractionDigits: 0 }
            );


        $('#id_produk').val(id);
        $('#hargaProd').val(harga);
        $('#IMGProduk').attr("src", foto);
        $('#Show_Img').attr("href", foto);
        $('#Nama_Produk').html(judul);
        $('#Harga_Produk').html('Rp. ' +harga_produk+ ' /Kg');
        $('#Deskripsi_Produk').html(deskripsi);
        $('#Persediaan_Awal').html('Persediaan Awal : '+awal + ' Kg');
        $('#Sisa_Persediaan').html('Sisa Persediaan : '+sisa + ' Kg');
        $('#Tahun_Produk').html('Tahun : '+tahun);
    });

        $('#save-filter-btn').click(function () {
        url = "{{ route('product.all') }}";
        DataProduk();
    });

    $('.AddCart').click(function(){
        url = "{{ route('add-cart') }}";

        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        var id = $('#id_produk').val();
        var qty = $('.num-product').val();
        var harga = $('#hargaProd').val();
        var user_id = $('#UserId').val();
        if (id != '' && user_id != '') {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id_produk' : id,
                    'id_user' : user_id,
                    'qty' : qty,
                    'harga' : harga,
                },
                dataType: "json",
                success: function (response) {
                    swal(nameProduct, "Dimasukkan ke keranjang ", "success");
                    totalkeranjang()
                }
            });
        } else {
            swal(nameProduct, "Gagal", "error");
        }
    });


    }

</script>

@endsection
