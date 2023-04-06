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
    <section id="why-us" class="why-us-cat">
      <div class="container">

        <div class="row mt-4">
          @forelse ($category->lessons as $lesson)

            <div class="col-lg-4 mt-4 mt-lg-3">
              <div class="box" style="background-image: url({{ asset("/img/$lesson->les_img") }});background-size: cover;background-position: center;background-repeat: no-repeat;">
                <h4>{{ $lesson->les_name }}</h4>
                <p>{{ $lesson->les_content }}</p>
                
                <div class="accordion mt-1" id="accordionExample">
                  <div class="accordion-item" style="border-radius: 13px">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button collapsed" style="border-radius: 13px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $lesson->les_id }}" aria-expanded="true" aria-controls="collapseOne">
                        Course's Requirements
                      </button>
                    </h2>
                    <div id="collapseOne{{ $lesson->les_id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body text-small">
                        <strong>This is the first item's accordion body.</strong>  
                        You can modify any of this with custom CSS or 
                        <div class="row">
                          <button class="btn btn-primary btn-small mt-1">Purchase</button>
                          <a href="{{ route('course.show', ['name' => $category->cat_name, 'course_name' => $lesson->les_name]) }}" class="btn btn-primary btn-small mt-1">Get Started</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <h6 class="mt-3 ml-3" style="font-size: 11px">Created: <strong class="text-primary" style="font-size: 11px; font-style:italic">{{ $lesson->created_at->format('d M Y \a\t H:i') }}</strong></h6>

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