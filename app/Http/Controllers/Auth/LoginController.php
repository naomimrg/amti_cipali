<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lokasi;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->role === 'Super Admin' || $user->role === 'Admin GSI') {
            return redirect('dashboard');
        } elseif ($user->role === 'Admin Vendor' || $user->role === 'User') {
            // Cari lokasi yang sesuai dengan id_vendor user dan ambil yang pertama
            $lokasi = Lokasi::where('id_vendor', $user->id_vendor)
                            ->orderBy('id', 'asc')
                            ->first();

            // Jika lokasi ditemukan, redirect ke halaman berdasarkan slug
            if ($lokasi) {
                return redirect("/home/{$lokasi->slug}");
            } else {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Default redirect jika role tidak cocok
        return redirect(RouteServiceProvider::HOME);
    }
}
