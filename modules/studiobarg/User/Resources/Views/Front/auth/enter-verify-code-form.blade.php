@extends('User::Front.auth.master')
<style>
    .activation-container {
        max-width: 400px;
        margin: 20px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .code-input {
        font-size: 20px;
        text-align: center;
        letter-spacing: 5px;
    }
</style>
@section('content')
    <div class="col-md-6 col-lg-7">
        <img src="/vendors/images/login-page-img.png" alt="">
    </div>
    <div class="col-md-6 col-lg-5">
        <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Send Verification Email</h2>
            </div>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Thanks for signing up! Before getting started.') }}
            </div>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
            <div class="d-flex items-center justify-content-between">
                <div class="activation-container text-center">
                    <p class="text-muted"> کدارسال شده به ایمیل {{request()->email}} را وارد کنید </p>
                    <form method="post" action="{{ route('password.checkVerifyCode') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ request()->email }}">

                        <div class="mb-3">
                            <input type="text" name="verify_code" class="form-control code-input" maxlength="6" placeholder="______" required>
                            @error('verify_code')
                            <span class="text-danger ml-1 mb-2 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">تأیید</button>
                    </form>
                <div class="d-flex mt-4 justify-content-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">کد را دریافت نکردید؟</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-light">
                            Log Out
                        </button>
                    </form>
                </div>
                </div>

            </div>

        </div>
    </div>
@endsection

