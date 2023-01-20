<nav id="navbar" class="navbar">
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
                <li><a href="{{ route('home.package') }}">Package</a></li>
                <li><a href="#">Claim</a></li>
            </ul>
        </li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li class="dropdown"><a href="javascript:void(0);"><span><i class="bi bi-person fs-5"></i></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
                @guest
                    <li><a href="{{ route('sign-in.member') }}">Masuk/Register</a></li>
                @endguest
                @auth
                    @can('is_member')
                        <li><a href="{{ route('member.dashboard') }}">Profile</a></li>
                        {{-- <li><a href="{{ route('member.claim') }}">Cart</a></li> --}}
                        <li><a href="{{ route('member.my-insurance') }}">My Insurance</a></li>
                        <li><a href="{{ route('member.claim') }}">Claim</a></li>
                        <hr class="py-0">
                        <li><a href="{{ route('sign-out.member') }}">Sign Out</a></li>
                    @endcan
                @endauth
            </ul>
        </li>
    </ul>
</nav>
