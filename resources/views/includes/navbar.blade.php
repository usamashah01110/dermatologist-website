<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home.page') }}">Derma<span>Care</span></a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home.page') ? 'active' : '' }}" href="{{ route('home.page') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about.page') ? 'active' : '' }}" href="{{ route('about.page') }}">About Us</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact.page') ? 'active' : '' }}" href="{{ route('contact.page') }}">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('dermatologists.page') ? 'active' : '' }}" href="{{ route('dermatologists.page') }}">Dermatologists</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <a href="#" class="nav-link btn-nav-login">Login</a>
        <a href="#" class="nav-link btn-nav-signup">Sign Up</a>
      </div>
    </div>
  </div>
</nav>