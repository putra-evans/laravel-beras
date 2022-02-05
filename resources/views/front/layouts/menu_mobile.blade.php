<ul class="main-menu-m">
    <li>
        <a href="{{ route('utama') }}">Home</a>
        <span class="arrow-main-menu-m">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
    </li>

    <li>
        <a href="{{ route('about-us') }}">Tentang Kami</a>
    </li>

    <li>
        <a href="contact.html">Kontak</a>
    </li>
    @if (Auth::user() != '')
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
    <li>
        <a href="{{ route('login') }}">Login</a>
    </li>

    <li>
        <a href="{{ route('register') }}">Register</a>
    </li>
    @endif

</ul>
