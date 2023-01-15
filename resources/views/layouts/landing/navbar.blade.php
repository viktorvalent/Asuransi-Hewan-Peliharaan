<nav id="navbar" class="navbar">
    <ul>
        <li><a href="{{ url('/le') }}">Home</a></li>
        <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
                <li><a href="#">Package</a></li>
                <li><a href="#">Claim</a></li>
            </ul>
        </li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
    {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
        <ul>
        <li><a href="#">Drop Down 1</a></li>
        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
            <li><a href="#">Deep Drop Down 1</a></li>
            <li><a href="#">Deep Drop Down 2</a></li>
            <li><a href="#">Deep Drop Down 3</a></li>
            <li><a href="#">Deep Drop Down 4</a></li>
            <li><a href="#">Deep Drop Down 5</a></li>
            </ul>
        </li>
        <li><a href="#">Drop Down 2</a></li>
        <li><a href="#">Drop Down 3</a></li>
        <li><a href="#">Drop Down 4</a></li>
        </ul>
    </li> --}}

        <li class="dropdown"><a href="javascript:void(0);"><span><i class="bi bi-person fs-5"></i></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
                @guest
                    <li><a href="{{ route('sign-in.member') }}">Masuk/Register</a></li>
                @endguest
                @auth
                    @if (auth()->user()->role==2)
                        <li><a href="{{ route('member.dashboard') }}">Profile</a></li>
                        <li><a href="{{ route('member.my-insurance') }}">My Insurance</a></li>
                        <li><a href="{{ route('member.dashboard') }}">Claim</a></li>
                        <hr class="py-0">
                        <li><a href="{{ route('sign-out.member') }}">Sign Out</a></li>
                    @endif
                @endauth
            </ul>
        </li>
    </ul>
</nav>
