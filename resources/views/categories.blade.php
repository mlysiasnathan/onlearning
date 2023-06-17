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
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" id="message-active">

      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <vue-alert type="bg-danger" message="{{ $error }}" :start="8"></vue-alert>
        @endforeach
      @endif

    </div>
    

    <!-- ======= Categories Section ======= -->
    <section id="portfolio" class="why-us-cat">
      <div class="container">

        @can('isAdmin')
          <a href="{{ route('category.create') }}" class="btn-get-started mt-3">
            <i class="bx bx-plus bx-flashing"> </i>New
          </a>
        @endcan
        
        <div class="row mt-1">
          @forelse ($categories as $category)

            <div class="col-lg-6 mt-lg-3 mt-4">
              <a href="{{ route('category.show', ['cat_name' => $category->cat_name]) }}">
                <div class="box" style="background-image: url( {{ Storage::url($category->cat_img) }});background-size: cover;background-position: center;background-repeat: no-repeat;">
                  <h4 class="text-uppercase">{{ $category->cat_name }}</h4>
                  <p>{{ $category->cat_description }}</p>
                  <h6 class="mt-3" style="font-size: 11px">Created: <strong style="font-size: 11px; font-style:italic">{{ $category->created_at->format('d/m/Y') }}</strong></h6>
                </div>
              </a>
              @can('isAdmin')
                <a href="{{ route('category.delete',['cat_id' => $category->cat_id]) }}" class="text-danger mt-3" onclick="return confirm('DELETE Category : : Are you sure ?')">
                  <i class="bx bx-trash bx-sm bx-border-circle bx-tada-hover mt-3"></i>
                </a>
                <a href="{{ route('category.update',['cat_id' => $category->cat_id]) }}" class="text-warning mt-3">
                  <i class="bx bx-pencil bx-sm bx-border-circle bx-tada mt-3"></i>
                </a>
              @endcan
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