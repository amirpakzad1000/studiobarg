<?php

namespace studiobarg\User\HTTP\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use studiobarg\User\HTTP\Requests\resetPasswordVerifyCodeRequest;
use studiobarg\User\HTTP\Requests\SendResetPasswordVerifyCodeRequest;
use studiobarg\User\Repositories\UserRepo;
use studiobarg\User\Services\VerifyCodeService;

class PasswordResetLinkController extends Controller
{

    public function showVerifyCodeRequestForm(): View
    {
        return view('User::Front.auth.forgot-password');
    }

    public function sendVerifyCodeEmail(SendResetPasswordVerifyCodeRequest $request)
    {
        $user = resolve(UserRepo::class)->findByEmail($request->email);
        if ($user && !VerifyCodeService::has($user->id)) {
            $user->sendResetPasswordRequestNotification();
        }
        return view('User::Front.auth.enter-verify-code-form');
    }

    public function checkVerifyCode(resetPasswordVerifyCodeRequest $request)
    {

        $user = resolve(UserRepo::class)->findByEmail($request->email);

        if ($user == null || !VerifyCodeService::check($user->id, $request->verify_code)) {
            return back()->withErrors(['verify_code' => 'کد وارد شده معتبر نمی باشد']);
        }
        auth()->loginUsingId($user->id);
        return redirect(route('password.showResetForm'));
    }
}
