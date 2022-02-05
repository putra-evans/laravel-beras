@extends('front.index')
@section('contents')
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Tentang Kami
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        Toko Beras H.Danir merupakan toko beras yang beralamat Jl. Pasir Sebelah No.41, Pasie Nan Tigo, Kec. Koto Tangah, Kota Padang, Sumatera Barat 25586, toko ini sudah berdiri lama dan terkenal dengan kualitas produk beras yang sangat bagus
                    </p>

                    {{-- <p class="stext-113 cl6 p-b-26">
                        Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac ligula.
                    </p> --}}

                    <p class="stext-113 cl6 p-b-26">
                        Berikut alamat kami :
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15957.470035678989!2d100.3364503!3d-0.8613162!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x45ebb2eab03f0b45!2sToko%20beras%20H.DANIR!5e0!3m2!1sid!2sid!4v1642753444610!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <img width="100%" src="{{asset('assets_front/toko.jpg')}}" alt="IMG">
                {{-- <div class="how-bor1 ">
                    <div class="hov-img0">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>

@endsection()
