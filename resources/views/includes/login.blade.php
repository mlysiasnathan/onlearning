<!-- login -->
    <div class="modal fade" id="login" role="dialog" aria-modal="true" data-bs-keyboard="true" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="containerLog" :class="loginSingUp()">
              <div class="forms">
                <div class="form login">
                  <span class="title">Login</span>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-field">
                      <input type="email" name="email" placeholder="Enter your email :" v-model="email" required>
                      <i class="bx bx-envelope icon"></i>
                    </div>
                    <h6 class="mt-1 text-danger " style="font-size: 13px" v-if="emailError">@{{ emailError }}</h6>
                    @if ($errors->any())
                        @foreach ($errors->get('email') as $error)
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $error }}</h5>
                        @endforeach
                    @endif
                    <div class="input-field">
                      <input class="password" :type="type" name="password" placeholder="Enter your Password :" v-model="password" required>
                      <i class="bx bx-lock icon"></i>
                      <i :class="icon" @@click.prevent.stop="showPassword"></i>
                    </div>
                    <h5 class="mt-1 text-danger" style="font-size: 13px" v-if="passwordError">@{{ passwordError }}</h5>
                    @if ($errors->any())
                        @foreach ($errors->get('password') as $error)
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $error }}</h5>
                        @endforeach
                    @endif
                    <div class="checkbox-text">
                      <div class="checkbox-content">
                        <input type="checkbox" name="" id="logCheck">
                        <label for="logCheck" class="text">Remember me</label>
                        
                      </div>
                      <a href="#" class="text">Forget password ?</a>
                      
                    </div>
                    <div class="input-field">
                      <button type="submit" name="" :disabled="muted" class="btn-get-started col-12" >Login Now</button>
                    </div>
          
                  </form>
                  <div class="login-signup">
                    <span class="text">Not a member ?
                      <a href="#logg" class="text signup-link" @@click.prevent.stop="link">Signup Now</a>
                    </span>
                    
                  </div>
                </div>
          
          
          
          <!-- signup form -->
          
                <div class="form signup">
                  <span class="title">Registration</span>
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-field">
                      <input type="text" name="username" id="name1" placeholder="Enter your names :" >
                      <i class="bx bx-user icon"></i>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->get('username') as $error)
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $error }}</h5>
                        @endforeach
                    @endif
                    <div class="input-field">
                      <input type="email" name="email_" placeholder="Enter your email :" >
                      <i class="bx bx-envelope icon"></i>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->get('email_') as $error)
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $error }}</h5>
                        @endforeach
                    @endif
                    <div class="input-field">
                      <input class="password" type="password" name="password_" placeholder="Create a Password :">
                      <i class="bx bx-lock icon"></i>
                      <i :class="icon" @@click.prevent.stop="showPassword"></i>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->get('password_') as $error)
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $error }}</h5>
                        @endforeach
                    @endif
                    <div class="input-field">
                      <input class="password" type="password" name="password_confirmation" placeholder="Confirm your password :">
                      <i class="bx bx-lock icon"></i>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->get('password_confirmation') as $error)
                            <h5 class="mt-1 text-danger" style="font-size: 13px">{{ $error }}</h5>
                        @endforeach
                    @endif
                    <div class="checkbox-text">
                      <div class="checkbox-content">
                        <input type="checkbox" name="" id="conditions">
                        <label for="conditions" class="text">Agree with condition</label>
                        
                      </div>						
                    </div>
                    <div class="input-field button">
                      <button type="submit" name="" class="btn-get-started scrollto col-12" >Signup Now</button>
                      {{-- <input type="submit" value="Signup Now"> --}}
                    </div>
          
                  </form>
                  <div class="login-signup mb-4">
                    <span class="text">Already a member ?
                      <a href="#log" class="text login-link" @@click.prevent.stop="link">Login Now</a>
                    </span>
                    
                  </div>
                  
                </div>
              <!-- end sign in section -->
