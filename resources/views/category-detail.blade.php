@extends('layouts.appLayout')
    
@section('content')

@include('includes.navbar')


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs pt-5">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Category <strong class="text-uppercase"> {{ $category->cat_name }}</strong></h2>
          <ol>
            <li><a href="{{ route('home') }}#portfolio-flters">Home</a></li>
            <li><a href="{{ route('categories.all') }}">Categories</a></li>
            <li class="text-uppercase">{{ $category->cat_name }}</li>
          </ol>
        </div>
      </div>
      
      @guest
        <!-- login -->
        @include('includes.login')
      @endguest

    </section><!-- End Breadcrumbs -->

    <div id="message-active" class="col-lg-4">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <vue-alert type="alert-danger" message="{{ $error }}" :start="8"></vue-alert>
        @endforeach
      @endif
    </div>
    

    <!-- ======= Category details Section ======= -->
    <section id="portfolio" class="why-us-cat">
      <div class="container">
        @can('isAdmin')
          <a href="{{ route('course.create',['cat_id' => $category->cat_id]) }}" class="btn-get-started mt-3">
            <i class="bx bx-plus bx-flashing"> </i>New
          </a>
        @endcan
        <div class="row mt-1">
          @forelse ($category->lessons as $lesson)

            <div class="col-lg-4 mt-4 mt-lg-3">
              <div class="box" style="background-image: url({{ Storage::url($lesson->les_img) }});background-size: cover;background-position: center;background-repeat: no-repeat;">
                <h4>
                  @auth
                    <i class="bi bi-coin bx-burst"></i><i class="bi bi-check bx-burst"> </i>
                  @endauth
                  {{ $lesson->les_name }}
                </h4>
                <p>{{ $lesson->les_content }}</p>
                
                <div class="accordion mt-1" id="accordionExample">
                  <div class="accordion-item border-primary" style="border-radius: 25px">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button text-primary collapsed" style="border-radius: 25px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $lesson->les_id }}" aria-expanded="true" aria-controls="collapseOne">
                        Get Started
                      </button>
                    </h2>
                    <div id="collapseOne{{ $lesson->les_id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body text-small">
                        <strong>Pre-requis.</strong>
                        <ul>
                          <li>You may know CSS</li>
                          <li>You may know html</li>
                          <li>You may know JavaScript</li>
                          <li>You may know Scss</li>
                        </ul>
                        
                        <div class="row">
                          <button class="btn-get-quote col mx-1">
                              <i class="bi bi-coin bx-burst"> </i>{{ $lesson->les_price }}
                            </button>
                            <a href="{{ route('course.show', ['cat_name' => $category->cat_name, 'les_name' => $lesson->les_name]) }}" class="btn-get-started col">
                              Start
                            </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @can('isAdmin')
                  <a href="{{ route('course.delete',['les_id' => $lesson->les_id]) }}" class="text-danger" onclick="return confirm('DELETE Course : : Are you sure ?')">
                    <i class="bx bx-trash bx-sm bx-border-circle bx-tada-hover mt-3"></i>
                  </a>
                  <a href="{{ route('course.update',['les_id' => $lesson->les_id , 'cat_id' => $category->cat_id]) }}" class="text-warning mt-3">
                    <i class="bx bx-pencil bx-sm bx-border-circle bx-tada mt-3"></i>
                  </a>
                @endcan

              </div>
              <h6 class="mt-3 ml-3" style="font-size: 11px">Created: 
                <strong class="text-primary" style="font-size: 11px; font-style:italic">{{ $lesson->created_at->format('d M Y \a\t H:i') }}</strong>
              </h6>
            </div>

          @empty
            <h1>Courses not published</h1>
          @endforelse

        </div>
      </div>
    </section><!-- End Category details Section -->

  </main><!-- End #main -->

  @include('includes.footer') 
     
  @endsection