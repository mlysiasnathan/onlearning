@extends('layouts.appLayout')
    
@section('content')

@include('includes.navbar')


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs pt-5">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Course <strong class="text-uppercase">{{ $course->les_name }}</strong></h2>
          <ol>
            <li><a href="{{ route('home') }}#portfolio-flters">Home</a></li>
            <li><a href="{{ route('categories.all') }}">Categories</a></li>
            <li><a href="{{ route('category.show', ['name' => $category_name]) }}">{{ $category_name }}</a></li>
            <li class="text-uppercase">{{ $course->les_name }}</li>
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

    <!-- ======= Lessons Section ======= -->
    <section id="why-us" class="why-us-cat">
        <div class="container">
  
          <div class="row mt-4">
  
            {{-- @forelse ($categories as $category) --}}
  
              <div class="col-lg-12">
                <div class="box" style="background-image: url({{ asset("/img/$course->les_img") }});background-size: cover;background-position: center;background-repeat: no-repeat;">
                    {{-- <h4 class="text-uppercase">php-basic</h4> --}}
                    <div class="accordion mt-1" id="accordionExample">
                        <div class="accordion-item" style="border-radius: 13px">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" style="border-radius: 13px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Course's descriptions
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-small">
                                {{$course->les_content}}
                            
                            </div>
                        </div>
                        </div>
                    </div>
                        
                    <h6 class="mt-3" style="font-size: 11px">Updated on : <strong style="font-size: 11px; font-style:italic">{{ $course->updated_at->format('M Y') }}</strong></h6>
                </div>
              </div>
              {{-- Lesson's Chapters --}}
              <h3 class="mt-3">Related files to download</h3>
              <div class="row">
                <button class="btn btn-outline-primary col-lg mt-1 m-2  rounded" type="button">Doc 1</button>
                <button class="btn btn-outline-primary col-lg mt-1 m-2  rounded" type="button">Doc 1</button>
              </div>

              <h3 class="mt-3">Tabes of contents & Lessons' videos</h3>

              <div class="accordion mt-3" id="accordionExample">
                <div class="accordion-item" style="border-radius: 13px">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed"  style="border-radius: 13px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                      Introduction
                    </button>
                  </h2>
                  <div id="collapseOne1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-small">
                      <strong>This is the first item's accordion body.</strong>  
                      You can modify any of this with custom CSS or overriding our default variables. 
                      It's also worth noting that just about any HTML can go within 
                      the, though the transition does limit overflow.
                      
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion mt-3" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Functions
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-small">
                      <strong>This is the first item's accordion body.</strong>  
                      You can modify any of this with custom CSS or overriding our default variables. 
                      It's also worth noting that just about any HTML can go within 
                      the, though the transition does limit overflow.
                      
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion mt-3" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Loops
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-small">
                      <strong>This is the first item's accordion body.</strong>  
                      You can modify any of this with custom CSS or overriding our default variables. 
                      It's also worth noting that just about any HTML can go within 
                      the, though the transition does limit overflow.
                      
                    </div>
                  </div>
                </div>
              </div>
  
            {{-- @empty
  
              <div class="alert alert-secondary">No category avalaibles</div>
              
            @endforelse --}}
              
          </div>
  
        </div>
      </section><!-- End Lessons Section -->
    



  </main><!-- End #main -->

@include('includes.footer') 
   
@endsection