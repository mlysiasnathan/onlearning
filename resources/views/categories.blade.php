@extends('layouts.appLayout')
    
@section('content')

@include('includes.navbar')

  <main id="main">
      

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs pt-5">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Categories</h2>
          <ol>
            <li><a href="{{ route('home') }}#portfolio-flters">Home</a></li>
            <li>Categories</li>
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
    

    <!-- ======= Categories Section ======= -->
    <section id="portfolio" class="why-us-cat">
      <div class="container">

        <a href="{{ route('category.create') }}" class="btn btn-primary mt-3">New</a>

        <div class="row mt-4">

          @forelse ($categories as $category)

            <div class="col-lg-4 mt-lg-3 mt-4">
              <a href="{{ route('category.show', ['cat_name' => $category->cat_name]) }}">
                <div class="box" style="background-image: url( {{ Storage::url($category->cat_img) }});background-size: cover;background-position: center;background-repeat: no-repeat;">
                  <h4 class="text-uppercase">{{ $category->cat_name }}</h4>
                  <p>{{ $category->cat_description }}</p>
                  <h6 class="mt-3" style="font-size: 11px">Created: <strong style="font-size: 11px; font-style:italic">{{ $category->created_at->format('d/m/Y') }}</strong></h6>
                </div>
              </a>
              <a href="{{ route('category.delete',['cat_id' => $category->cat_id]) }}" class="btn btn-outline-danger mt-3" onclick="return confirm('Do you want to delete this category ?')">DEL</a>
              <a href="{{ route('category.update',['cat_id' => $category->cat_id]) }}" class="btn btn-outline-warning mt-3">EDT</a>

            </div>

          @empty

            <div class="alert alert-secondary">No category avalaibles</div>
            
          @endforelse
            
        </div>

      </div>
    </section><!-- End Categories Section -->

  </main><!-- End #main -->

  @include('includes.footer') 
     
  @endsection