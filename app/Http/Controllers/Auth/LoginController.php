<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Lokasi;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $response = Http::asForm()
            ->withOptions([
                'verify' => storage_path('cert/cacert.pem'),
            ])
            ->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

        $captchaData = $response->json();

        if (!($captchaData['success'] ?? false)) {
            return back()->withErrors([
                'g-recaptcha-response' => 'Captcha verification failed.',
            ])->withInput();
        }

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->role === 'Super Admin' || $user->role === 'Admin GSI') {
            return redirect('dashboard');
        } elseif ($user->role === 'Admin Vendor' || $user->role === 'User') {
            $lokasi = Lokasi::where('id_vendor', $user->id_vendor)
                ->orderBy('id', 'asc')
                ->first();

            if ($lokasi) {
                return redirect("/home/{$lokasi->slug}");
            } else {
                return redirect(RouteServiceProvider::HOME);
            }
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
