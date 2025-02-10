<?php

namespace studiobarg\User\HTTP\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use studiobarg\User\Models\User;
use studiobarg\User\Rules\validMobile;
use studiobarg\User\Rules\validPassword;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('User::Front.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['nullable', 'string', 'lowercase','min:9','max:14', 'unique:'.User::class,new validMobile()],
            'password' => ['required', 'confirmed', new validPassword()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
	        'mobile' => request('mobile'),
        ]);
        // ارسال ایمیل تأیید
        event(new Registered($user));

        // لاگین کاربر و هدایت به صفحه تأیید ایمیل
        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
