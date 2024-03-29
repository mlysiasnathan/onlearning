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
            <li><a href="{{ route('category.show', ['cat_name' => $category_name]) }}">{{ $category_name }}</a></li>
            <li class="text-uppercase">{{ $course->les_name }}</li>
          </ol>
        </div>

      </div>
      
        @guest
    <!-- login -->
            @include('includes.login')
        @endguest
    </section><!-- End Breadcrumbs -->

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" id="message-active">

      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <vue-alert type="bg-danger" message="{{ $error }}" :start="8"></vue-alert>
        @endforeach
      @endif

    </div>

    <!-- ======= Lessons Section ======= -->
    <section id="portfolio" class="why-us-cat">
        <div class="container">
  
          <div class="row mt-4">
    
              <div class="col-lg-12">
                <div class="box" style="background-image: url({{ Storage::url($course->les_img) }});background-size: cover;background-position: center;background-repeat: no-repeat;">
                    <div class="accordion mt-1" id="accordionExample">
                        <div class="accordion-item border-primary" style="border-radius: 25px">
                          <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button collapsed" style="border-radius: 25px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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

                    <h6 class="mt-3" style="font-size: 11px">
                      @auth
                        <i class="bi bi-coin bx-burst"></i><i class="bi bi-check bx-burst"> </i>
                      @endauth
                      Updated on : <strong style="font-size: 11px; font-style:italic">{{ $course->updated_at->format('M Y') }}</strong>
                    </h6>
                </div>
              </div>

              {{-- Lesson's documentations --}}
              @can('isAdmin')

                <div class="row">
                  <div class="col-lg-6 py-5">

                    <form class="form-control" action="{{  route('doc.create', ['les_id' => $course->les_id]) }}" method="POST" enctype="multipart/form-data"  style="border-radius: 25px" onsubmit="return confirm('CREATE Doc : : Are you sure ?')">
                      @csrf
                      <label for="">Insert a documentation :</label>
                      <div class="input-field mx-3">
                        <input type="file" name="document" required>
                      </div>
                      <button type="submit" class="btn-get-started col-12 mt-3"><i class="bx bx-book"></i>  Add Doc</button>
                        @if ($errors->any())
                            @foreach ($errors->get('document') as $error)
                                <h5 style="color: red">{{ $error }}</h5>
                            @endforeach
                        @endif
                    </form>
                  </div>

                  <div class="col-lg-6 py-1">

                    <form class="form-control" action="{{  route('video.create', ['les_id' => $course->les_id]) }}" method="POST" enctype="multipart/form-data" style="border-radius: 25px" onsubmit="return confirm('CREATE Video : : Are you sure ?')">
                      @csrf
                      <div class="input-field mx-3 mt-3">
                        <input type="text" placeholder="New video name :" name="video_name" required>
                      </div>
                        @if ($errors->any())
                            @foreach ($errors->get('video_name') as $error)
                                <h5 style="color: red">{{ $error }}</h5>
                            @endforeach
                        @endif
                        <br/><br/>
                      <div class="input-field mx-3">
                        <input type="text" placeholder="New video youtube link :" name="video_link" required>
                      </div>
                        @if ($errors->any())
                            @foreach ($errors->get('video_link') as $error)
                                <h5 style="color: red">{{ $error }}</h5>
                            @endforeach
                        @endif
                      <button type="submit" class="btn-get-started col-12 mt-2"><i class="bx bx-video"></i>  Add Video</button>
                    </form>
                  </div>
                </div>
              @endcan

              @if ($course->lesson_pdfs->count() > 0)

                    <h3 class="mt-3">Related files to download</h3>
                    <div class="row">

                      @foreach ($course->lesson_pdfs as $document)
                        <a href="{{ route('doc.download' , ['pdf_id' => $document->pdf_id]) }}" class="btn-get-quote col-lg mt-1 m-1" onclick="return confirm('DOWNLOAD Document : : Do you want to download this document ?')">
                          <i class="bx bx-download bx-fade-down"></i> - <i class="bx bx-book"></i> {{ $document->pdf_id }}
                        </a>
                        
                        @can('isAdmin')
                          <a href="{{ route('doc.delete', ['pdf_id' => $document->pdf_id]) }}" class="col-1 text-small mt-1 text-danger" onclick="return confirm('DELETE Document : : Are you sure ?')">
                            <i class="bx bx-trash bx-sm bx-border-circle bx-burst"></i>
                          </a>
                        @endcan
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
                        <button class="accordion-button collapsed text-primary"  style="border-radius: 13px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $video->vid_id }}" aria-expanded="true" aria-controls="collapseOne">
                          <i class="bx bx-play bx-border-circle bx-tada"> </i>{{ $video->vid_name }}
                        </button>
                      </h2>
                      <div id="collapseOne{{ $video->vid_id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-small">
                          <div class="embed-responsive embed-responsive-16y9">
                            <iframe src="{{ $video->vid_file }}" frameborder="0" class="embed-responsive-item" allowfullscreen style="border-radius: 13px"></iframe>
                          </div>
                          <h6 class="text-samll">{{ $video->vid_file }}</h6>

{{-- Update form --}}
                        @can('isAdmin')
                          <form class="form-control" action="{{  route('video.update', ['les_id' => $course->les_id , 'vid_id' => $video->vid_id]) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('UPDATE Video : : Are you sure to edit this chapter ?')">
                            @csrf
                            <div class="input-field mx-3 mt-3">
                              <input type="text" placeholder="Edit video name :" name="video_name" value="{{ $video->vid_name }}">
                            </div>
                            @if ($errors->any())
                                  @foreach ($errors->get('video_name') as $error)
                                      <h5 style="color: red">{{ $error }}</h5>
                                  @endforeach
                              @endif
                              <br/><br/>
                            <div class="input-field mx-3">
                              <input type="text" placeholder="Edit video youtube link :" name="video_link" value="{{ $video->vid_file }}" required>
                            </div>
                            @if ($errors->any())
                                  @foreach ($errors->get('video_link') as $error)
                                      <h5 style="color: red">{{ $error }}</h5>
                                  @endforeach
                              @endif
                              <br/><br/>
                            <button type="submit" class="btn-get-started col-10"><i class="bx bx-pencil"></i></button>
                            <a href="{{ route('video.delete', ['vid_id' => $video->vid_id]) }}" class="text-danger col-1" onclick="return confirm('DELETE Video : : Are you sure ?')"><i class="bx bx-trash bx-border-circle bx-burst"></i></a>
                          </form>
                        @endcan
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