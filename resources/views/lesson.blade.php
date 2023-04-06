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

              {{-- Lesson's documentations --}}
                @if ($course->lesson_pdfs->count() > 0)

                    <h3 class="mt-3">Related files to download</h3>
                    <div class="row">

                      @foreach ($course->lesson_pdfs as $document)
                        <button class="btn btn-outline-primary col-lg mt-1 m-2  rounded" type="button">Doc {{ $document->pdf_id }}</button>
                      @endforeach
                      
                    </div>

                @else

                    <h3 class="mt-3">No additionnal Related files for this course</h3>
                  
                @endif
              {{-- Lesson's Chapters --}}
              @if ($course->lesson_videos->count() > 0)

                <h3 class="mt-3">Tabes of contents & Lessons' videos</h3>

                @foreach ($course->lesson_videos as $video)

                  <div class="accordion mt-3" id="accordionExample">
                    <div class="accordion-item" style="border-radius: 13px">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed"  style="border-radius: 13px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $video->vid_id }}" aria-expanded="true" aria-controls="collapseOne">
                          {{ $video->vid_name }}
                        </button>
                      </h2>
                      <div id="collapseOne{{ $video->vid_id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-small">
                          <div class="embed-responsive embed-responsive-16y9">
                            <iframe src="{{ $video->vid_file }}" frameborder="0" class="embed-responsive-item" allowfullscreen style="border-radius: 13px"></iframe>
                          </div>
                          <h6 class="text-samll">{{ $video->vid_file }}</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                @endforeach

              @else

                  <h3 class="mt-3">No video deployed yet for this course</h3>
                
              @endif

          </div>
        </div>
      </section><!-- End Lessons Section -->
      
  </main><!-- End #main -->

@include('includes.footer') 
   
@endsection