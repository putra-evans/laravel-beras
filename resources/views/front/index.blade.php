<!DOCTYPE html>
<html lang="en">

<head>
    <title>Selamat Datang | Toko beras H.DANIR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    @include('front.layouts.header')
    <!--===============================================================================================-->
</head>

<body class="animsition">
    <!-- Header -->
    <header class="header-v3">
        <!-- Header desktop -->
        <div class="container-menu-desktop trans-03">
            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop p-l-45">

                    <!-- Logo desktop -->
                    <a href="#" class="logo">
                        <img src="{{asset('assets_front/images/icons/logo-02.png')}}" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            @if (Auth::user() != '')
                            <li>
                                <a href="{{ route('beranda') }}">Home</a>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('utama') }}">Home</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('about-us') }}">Tentang Kami</a>
                            </li>
                            <li>
                                <a href="{{ route('kontak-kami') }}">Kontak</a>
                            </li>

                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m h-full">
                        <div class="flex-c-m h-full p-r-25 bor6">
                            <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart BtnKeranjang" id="TotKeranjang" data-notify="0">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>

                        <div class="flex-c-m h-full p-lr-19">
                            <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="{{asset('assets_front/images/icons/logo-01.png')}}" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
                <div class="flex-c-m h-full p-r-5">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart BtnKeranjang" id="TotKeranjangMobile"
                        data-notify="0">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
        <!-- Menu Mobile -->
        <div class="menu-mobile">
            @include('front.layouts.menu_mobile')
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <button class="flex-c-m btn-hide-modal-search trans-04">
                <i class="zmdi zmdi-close"></i>
            </button>

            <form class="container-search-header">
                <div class="wrap-search-header">
                    <input type="hidden" name="UserId" id="UserId" value="{{ Auth::check() ? Auth::user()->id : '' }}">
                    <input class="plh0" type="text" name="search" placeholder="Search...">

                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </header>


    <!-- Sidebar -->
    @include('front.layouts.sidebar')


    <!-- Cart -->
    @include('front.layouts.keranjang')



    <!-- Slider -->
    {{-- @include('front.layouts.slider') --}}


    <!-- Product -->
    <section class="bg0 p-t-95 p-b-130">
        @yield('contents')
    </section>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>



    <!--===============================================================================================-->
    @include('front.layouts.js')
    @yield('script')


</body>

</html>
