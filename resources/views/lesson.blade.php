@extends('layouts.appLayout')
    
@section('content')

@include('includes.navbar')


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs pt-5">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Course <strong class="text-uppercase"> php</strong></h2>
          <ol>
            <li><a href="{{ route('home') }}#portfolio-flters">Home</a></li>
            <li><a href="{{ route('categories.all') }}">Categories</a></li>
            <li><a href="{{ route('category.show', ['name' => 'php']) }}">php</a></li>
            <li class="text-uppercase">php-basic</li>
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
    

<h1>Lesson</h1>


</main><!-- End #main -->

@include('includes.footer') 
   
@endsection