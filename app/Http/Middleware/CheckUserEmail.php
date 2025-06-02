<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userEmail = Auth::user()->email;

            // Cek apakah email user ada di tabel siswa atau guru
            $isSiswa = Siswa::where('email', $userEmail)->exists();
            $isGuru = Guru::where('email', $userEmail)->exists();

            if (!$isSiswa && !$isGuru) {
                Auth::logout(); // Logout user jika email tidak cocok di kedua tabel
                return redirect('/login')->with('error', 'Email tidak terdaftar sebagai siswa maupun guru.');
            }
        }
        
        return $next($request);
    }
}