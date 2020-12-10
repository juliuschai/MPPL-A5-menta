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
}
