<aside class="wrap-sidebar js-sidebar">
    <div class="s-full js-hide-sidebar"></div>

    <div class="sidebar flex-col-l p-t-22 p-b-25">
        <div class="flex-r w-full p-b-30 p-r-27">
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
            <ul class="sidebar-link w-full">
                @if (Auth::user() != '')
                <li class="p-b-13">
                    <a href="{{ route('beranda') }}" class="stext-102 cl2 hov-cl1 trans-04">
                        Home
                    </a>
                </li>
                <li class="p-b-13">
                    <a href="{{ route('my-order') }}" class="stext-102 cl2 hov-cl1 trans-04">
                        Pesanan Saya
                    </a>
                </li>

                <li class="p-b-13">
                    <a href="#" class="stext-102 cl2 hov-cl1 trans-04">
                        {{ Auth::user()->name }}
                    </a>
                </li>

                <li class="p-b-13">
                    <a class="stext-102 cl2 hov-cl1 trans-04" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </li>
                @else
                {{-- <li class="p-b-13">
                    <a href="{{ route('utama') }}" class="stext-102 cl2 hov-cl1 trans-04">
                        Home
                    </a>
                </li> --}}
                <li class="p-b-13">
                    <a href="{{route('login')}}" class="stext-102 cl2 hov-cl1 trans-04">
                        Login
                    </a>
                </li>
                <li class="p-b-13">
                    <a href="{{ route('register') }}" class="stext-102 cl2 hov-cl1 trans-04">
                        Register
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</aside>
