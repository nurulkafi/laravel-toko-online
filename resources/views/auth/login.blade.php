@extends('user.layout.main')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<section class="chart-page padding-top-100 padding-bottom-100">
      <div class="container">

        <!-- Payments Steps -->
        <div class="shopping-cart">

          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row">

              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-7">
                <h6>LOGIN YOUR ACCOUNT</h6>
                <form method="POST" action="{{ route('login') }}">
                  <ul class="row">
                    @csrf
                    <!-- Name -->
                    <li class="col-md-12">
                      <label> EMAIL
                        <input type="email" name="email" value="" placeholder="">
                      </label>
                      @error('email')
                        <strong>{{ $message }}</strong>
                      @enderror
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-12">
                      <label> PASSWORD
                        <input type="password" name="password" value="" placeholder="">
                      </label>
                      @error('password')
                              <strong>{{ $message }}</strong>
                      @enderror
                    </li>

                    <!-- LOGIN -->
                    <li class="col-md-4">
                      <button type="submit" class="btn">LOGIN</button>
                    </li>

                    <!-- CREATE AN ACCOUNT -->
                    <li class="col-md-4">
                      <div class="checkbox margin-0 margin-top-20">
                        <input id="checkbox1" class="styled" type="checkbox">
                        <label for="checkbox1"> Stay me Login</label>
                      </div>
                    </li>

                    <!-- FORGET PASS -->
                    <li class="col-md-4">
                      <div class="checkbox margin-0 margin-top-20 text-right">
                        <a href="#.">Forget Password</a>
                      </div>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
