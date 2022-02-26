@extends('front.index')
@section('contents')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url({{ asset('assets_front/toko.jpg') }});">
        <h2 class="ltext-105 cl0 txt-center">
            Kontak Kami
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-map-marker"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Alamat
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                Jl. Sparman No.88 Lolong, Padang,Kota Padang, Sumatera Barat
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Telp
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                +6282354324422
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Email
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                tokoberas@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Map -->
    <div class="map">
        <div class="size-303">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15957.470035678989!2d100.3364503!3d-0.8613162!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x45ebb2eab03f0b45!2sToko%20beras%20H.DANIR!5e0!3m2!1sid!2sid!4v1642753444610!5m2!1sid!2sid"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
@endsection()
