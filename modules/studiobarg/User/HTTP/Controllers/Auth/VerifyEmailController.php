<?php

namespace studiobarg\User\HTTP\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use studiobarg\User\Services\VerifyCodeService;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');

        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }

    public function verify(Request $request)
    {
        if ( !VerifyCodeService::check(auth()->id(), $request->verify_code )) {
            return back()->withErrors(['verify_code' => 'The provided code is not correct.']);
        }
        auth()->user()->markEmailAsVerified();
        return redirect()->route('dashboard');

    }
}
