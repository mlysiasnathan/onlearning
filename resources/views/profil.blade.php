@extends('layouts.appLayout')
    
@section('content')

@include('includes.navbar')


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs pt-0">
      
      
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



    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container">
    
            <div class="section-title">
                <h2>My Profil</h2>
                <p>All about my personal information is here</p>
            </div>
    
            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" style="border-radius: 15px">
                        <div class="member-img">
                            <img src="{{ Storage::url($user->path) }}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="{{ $user->email }}"><i class="bi bi-google"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>{{ $user->user_name }}</h4>
                            <span>Student</span>
                        </div>
                    </div>
                </div>

                <div class="form signup col">
                    <form method="POST" action="{{ route('profil.store') }}" enctype="multipart/form-data" onsubmit="return confirm('UPDATE Profil : : Are you sure ?')">
                        @csrf
                        <div class="row">

                            <div class="input-field col-lg">
                                <input type="text" name="username_update" value="{{ $user->user_name }}" id="name1" placeholder="Enter your new names :" >
                                <i class="bx bx-user bx-sm icon"></i>
                            </div>
                            @error('username_update')
                                <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $message }}</h5>
                            @enderror
                            <div class="input-field col-lg">
                                <input type="email" name="email_update" value="{{ $user->email }}" placeholder="Enter your new email :" >
                                <i class="bx bx-envelope bx-sm icon"></i>
                            </div>
                            @error('email_update')
                                <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $message }}</h5>
                            @enderror 
                        </div>
                        <div class="input-field">
                            <input class="password" type="password" name="password_update" placeholder="Create a new Password :">
                            <i class="bx bx-lock bx-sm icon"></i>
                            <i :class="icon" @@click.prevent.stop="showPassword"></i>
                        </div>
                        @error('password_update')
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $message }}</h5>
                        @enderror 
                        <div class="input-field">
                            <input class="password" type="password" name="password_confirmation_update" placeholder="Confirm your new password :">
                            <i class="bx bx-lock bx-sm icon"></i>
                        </div>
                        @error('password_confirmation_update')
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $message }}</h5>
                        @enderror
                        
                        <div class="input-field">
                            <input class="password" type="file" name="profil_img">
                            <i class="bx bx-image bx-tada bx-sm icon"></i>
                        </div>
                        @error('profil_img')
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $message }}</h5>
                        @enderror
                </div>
                        <div class="input-field button mt-1">
                            <button type="submit" name="" class="btn-get-started scrollto col-12" >Update my profil</button>
                        </div>
            
                    </form>
            </div>
        </div>
        
    </section><!-- End Team Section -->

</main><!-- End #main -->

@include('includes.footer') 
   
@endsection