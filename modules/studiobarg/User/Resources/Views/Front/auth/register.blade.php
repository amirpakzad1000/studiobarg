@extends('User::Front.auth.master')
@section('content')
    <div class="col-md-6 col-lg-7">
        <img src="vendors/images/register-page-img.png" alt=""/>
    </div>
    <div class="col-md-6 col-lg-5">
        <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Register User</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                @error('name')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                           autofocus autocomplete="name" placeholder="Full Name *" value="{{ old('name') }}"/>
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                    </div>
                </div>

                @error('email')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                           name="email" autocomplete="email"
                           placeholder="email *" value="{{ old('email') }}">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-email2"></i></span>
                    </div>
                </div>

                @error('mobile')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                           name="mobile" autocomplete="mobile"
                           placeholder="mobile" value="{{ old('mobile') }}">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-phone-call"></i></span>
                    </div>
                </div>

                @error('password')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input id="password" class="form-control @error('password') is-invalid @enderror"
                           type="password"
                           name="password"
                           autocomplete="new-password" placeholder="Password *" value="{{ old('password') }}">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-password"></i></span>
                    </div>
                </div>

                @error('confirmed')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input class="form-control" id="password_confirmation" type="password"
                           name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password *">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-password"></i></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">register</button>
                        </div>
                        <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373"
                             style="color: rgb(112, 115, 115);">
                            OR
                        </div>
                        <div class="input-group mb-0">
                            <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
