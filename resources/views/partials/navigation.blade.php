<section class="nav-bar">
    <div class="nav-container">
        <div class="brand">
            <a href="{{ route('home') }}"><img src="" /></a>
        </div>
        <nav>
            <div class="nav-mobile">
                <a id="nav-toggle" href="#!"><span></span></a>
            </div>
            <ul class="nav-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('flights') }}">Flights</a></li>
                <li><a href="{{ route('faq-feedback') }}">FaQ & Feedback</a></li>
                <li><a href="#yyy">About</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login or Register</a></li>
                @else
                    <li><a href="#">{{ Auth::user()->name }}</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                    </li>
                @endguest
                <li><a href="{{ route('searchflights') }}"><i class="fa-solid fa-magnifying-glass"></i></a></li>
            </ul>
        </nav>
    </div>
</section>