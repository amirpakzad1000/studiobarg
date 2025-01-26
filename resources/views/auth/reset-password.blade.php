@extends('backend.auth.master')
@section('content')
    <div class="col-md-6 col-lg-7">
        <img src="/vendors/images/login-page-img.png" alt="">
    </div>
    <div class="col-md-6 col-lg-5">
        <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Login To DeskApp</h2>
            </div>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                @error('email')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                           placeholder="Username or Email" value="{{ old('email', $request->email) }}"
                           id="email" type="email" name="email" required autofocus autocomplete="email" >
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                    </div>
                </div>

                @error('password')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input class="form-control form-control-lg"
                           placeholder="new password"
                           id="password"
                           type="password"
                           name="password"
                           required autocomplete="new-password" >
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                    </div>
                </div>

                @error('password_confirmation')
                <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group custom">
                    <input class="form-control form-control-lg"
                           placeholder="confirm password"
                           id="password_confirmation" type="password"
                           name="password_confirmation" required autocomplete="new-password" >
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Change Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

