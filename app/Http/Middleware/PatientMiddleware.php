<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class PatientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::cur();
        if (!$user->isAdmin() && !$user->isPatient()) {
            abort(403, 'Anda bukan pasien');
        }
        return $next($request);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect('login')->withErrors(['error1' => 'Email or password not found']);
        }

        if (!User::cur()->isPatient()) {
            Auth::logout();
            abort(403, 'Bukan user, silahkan login di therapist.menta.com');
        }

        return redirect()->intended('home');
    }
}
