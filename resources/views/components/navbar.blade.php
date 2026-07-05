<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            <i class="fas fa-hotel"></i> Hotel<span>Booking</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('home')}}"><i class="fas fa-home me-1"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('services')}}"><i class="fas fa-concierge-bell me-1"></i> Services</a>
                </li>
                @auth
                <li class="nav-item ms-3">
                    <span class="navbar-username">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </span>
                </li>
                @endauth
                <li class="nav-item ms-3">
                    @guest
                    <a class="btn btn-login" href="{{route('loginPage')}}"><i class="fas fa-user me-1"></i> Login</a>
                    @endguest
                    @auth
                         @if(Auth::user()->role == 'admin')
                            <a class="btn btn-login" href="{{route('adminHome')}}">Admin Panel</a>
                         @endif
                    <a class="btn btn-login" href="{{route('logout')}}">Log Out</a>
                    @endauth
                </li>
                <li class="nav-item ms-2">
                    @guest
                    <a class="btn btn-signup" href="{{route('signupPage')}}"><i class="fas fa-user-plus me-1"></i> Sign Up</a>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>