@extends('backend.auth.master')
@section('content')
    <div class="col-md-6 col-lg-7">
        <img src="vendors/images/register-page-img.png" alt=""/>
    </div>
    <div class="col-md-6 col-lg-5">
        <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Login To DeskApp</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                    @csrf

                @error('email')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" name="email" autocomplete="email"
                           placeholder="email">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-email2"></i></span>
                    </div>
                </div>

                @error('password')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" name="password" autocomplete="password"
                           placeholder="password">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-password"></i></span>
                    </div>
                </div>

                @error('confirmed')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" id="password_confirmation"
                           name="password_confirmation" required autocomplete="new-password">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-password"></i></span>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-lg" name="city" autocomplete="city"
                               placeholder="city">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-lg" name="country" autocomplete="country"
                               placeholder="country">
                    </div>
                </div>
                <div class="row pb-30">
                    <div class="col-6">
                        <div class="forgot-password">
                            <a href="forgot-password.html">Forgot Password</a>
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
                            <button class="btn btn-primary btn-lg btn-block" type="submit">register</button>
                        </div>
                        <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373"
                             style="color: rgb(112, 115, 115);">
                            OR
                        </div>
                        <div class="input-group mb-0">
                            <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('login') }}">Register To
                                Create Account</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
