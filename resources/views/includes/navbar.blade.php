<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home.page') }}">
      <i class="fas fa-heart-pulse me-2"></i>Derma<span>Connect</span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto gap-2">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home.page') ? 'active' : '' }}" href="{{ route('home.page') }}">
            <i class="fas fa-home me-1"></i>Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <i class="fas fa-info-circle me-1"></i>About Us
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <i class="fas fa-envelope me-1"></i>Contact Us
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <i class="fas fa-user-md me-1"></i>Dermatologists
          </a>
        </li>
     
      </ul>
      <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
        @guest
          <a href="{{ route('login') }}" class="nav-link btn-nav-login">
            <i class="fas fa-sign-in-alt me-1"></i>Login
          </a>
          <a href="{{ route('register') }}" class="nav-link btn-nav-signup">
            <i class="fas fa-user-plus me-1"></i>Sign Up
          </a>
        @endguest
        @auth
          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="nav-link btn-nav-login btn btn-link text-start">
              <i class="fas fa-sign-out-alt me-1"></i>Logout
            </button>
          </form>
        @endauth
      </div>
    </div>
  </div>
</nav>