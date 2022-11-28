  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top m-2">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ route("home") }}" class="logo"><img src="{{ asset("/img/apple-touch-icon.png") }}" rel="icon" alt="" class="img-fluid small"></a>
      <h1 class="logo"><a href="{{ route("home") }}">OnLearning</a></h1>      

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Categories & Courses</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          @guest
            <li><a class="getstarted scrollto" data-bs-toggle="modal" data-bs-target="#login">Log in</a>
          @endguest
          @auth
            <li class="dropdown"><a href="#"><img src="{{ asset("/img/favicon.png") }}" alt="" class="img-fluid" id="profil-pic"> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#">Dark Mode</a></li>
                <li class="dropdown"><a href="#"><span>{{ Auth::user()->user_name }} 's profil</span> <i class="bi bi-chevron-right"></i></a>
                  <!-- <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                  </ul> -->
                </li>
                <li><!-- Authentication -->
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf

                      <a href="logout" class="text-danger font-weight-bold" onclick="event.preventDefault();
                                          this.closest('form').submit();">
                          {{ __('Log out') }}
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