<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyRecaptcha
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') && $request->routeIs('login')) {
            // validasi field ada
            $request->validate(['g-recaptcha-response' => 'required']);

            $resp = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => config('services.recaptcha.secret_key'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]
            );

            if (!data_get($resp->json(), 'success')) {
                return back()
                    ->withErrors(['g-recaptcha-response' => 'Captcha tidak valid.'])
                    ->withInput();
            }
        }
        return $next($request);
    }
}
