@extends('User::Front.auth.master')
@section('content')
    <div class="col-md-6 col-lg-7">
        <img src="vendors/images/login-page-img.png" alt="">
    </div>
    <div class="col-md-6 col-lg-5">
        <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Login To DeskApp</h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @error('login')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                           placeholder="Username or Email" value="{{ old('email') }}"
                           id="login" type="text" name="login" required autofocus autocomplete="username">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                    </div>
                </div>


                <div class="input-group custom">
                    <input class="form-control form-control-lg"
                           placeholder="**********"
                           id="password"
                           type="password"
                           name="password"
                           required autocomplete="current-password">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                    </div>
                </div>

                <div class="row pb-30">
                    <div class="col-6">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                            <label class="custom-control-label" for="customCheck1">{{ __('Remember me') }}</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="forgot-password">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot Password</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <!--
                            use code for form submit
                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                        -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                        </div>
                        <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373"
                             style="color: rgb(112, 115, 115);">
                            OR
                        </div>
                        <div class="input-group mb-0">
                            <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('register') }}">Register
                                To Create Account</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
