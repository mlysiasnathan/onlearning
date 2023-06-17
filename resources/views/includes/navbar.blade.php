  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top m-2">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ route("home") }}" class="logo"><img src="{{ asset("/img/favicon.jpg") }}" rel="icon" alt="" class="img-fluid rounded large"></a>
      <h1 class="logo"><a href="{{ route("home") }}">OnLearning</a></h1>      

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="{{ route("home") }}#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="{{ route("home") }}#about">About</a></li>
          <li><a class="nav-link scrollto" href="{{ route("home") }}#services">Services</a></li>
          <li><a class="nav-link scrollto" href="{{ route("home") }}#portfolio">Categories & Courses</a></li>
          <li><a class="nav-link scrollto" href="{{ route("home") }}#team">Team</a></li>
          
          <li><a class="nav-link scrollto" href="{{ route("home") }}#contact">Contact</a></li>
          @guest
            <li><a class="getstarted scrollto" data-bs-toggle="modal" data-bs-target="#login">Log in</a>
          @endguest
          
          @auth
            <li class="dropdown"><a href="#">
              <img src="{{ Storage::url(auth()->user()->path) }}" alt="" class="img-fluid" id="profil-pic"> <i class="bi bi-chevron-down"></i>
            </a>
              <ul>
                <li><a href="#">Dark Mode<i class="bx bx-moon bx-sm"></i></a></li>
                <li class="dropdown"><a href="#"><span>{{ auth()->user()->user_name }} 's profil</span> <i class="bi bi-chevron-right"></i></a>
                  <ul>
                    <li><a href="#"><i class="bx bx-user bx-sm"></i>{{ auth()->user()->user_name }}</a></li>
                    <li><a href="#"><i class="bx bx-envelope bx-sm"></i>{{ auth()->user()->email }}</a></li>
                    <li><a href="#" class="btn btn-outline-primary m-1 rounded"><i class="bx bx-history bx-sm"></i>Current course</a></li>
                    <li><a href="{{ route('profil.show') }}" class="text-warning btn btn-outline-primary m-1 rounded"><i class="bx bx-pencil bx-flashing bx-sm"></i>Edit my profil</a></li>
                  </ul>
                </li>
                <li><!-- Authentication -->
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="logout" class="btn btn-outline-danger text-danger m-1 font-weight-bold" onclick="event.preventDefault(); confirm('LOGOUT : : Are you sure ?') ? this.closest('form').submit() : event.preventDefault()"> {{ __('Log out') }}
                  </a>
                  </form></li>
              </ul>
            </li>
          @endauth
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  