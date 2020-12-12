<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class TherapistVerified
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
        $therapist = User::cur()->therapist;
        if (!$therapist->isVerified()) {
            if ($therapist->documentExists()) {
                return redirect()->route('therapist.verify');
            } else {
                return redirect()->route('therapist.verify.wait');
            }
        }
        return $next($request);
    }
}
