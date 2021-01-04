<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Therapist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    // Landing page therapist
    public function index()
    {
        return view('therapist.welcome');
    }

    // Home/dashboard page tharpist
    public function home()
    {
        return view('therapist.home');
    }

    // Override laravel default register by injecting user roles
    public function register(Request $request)
    {
        $request['role'] = 'therapist';
        $route = (new RegisterController())->register($request);

        if (Auth::check()) {
            $therapist = new Therapist();
            $therapist->user_id = Auth::id();
            $therapist->save();
        }
        return $route;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->remember)) {
            return redirect('login')->withErrors([
                'Email or password not found',
            ]);
        }

        if (!User::cur()->isTherapist()) {
            Auth::logout();
            abort(403, 'Bukan terapis, silahkan login di menta.website');
        }

        return redirect()->intended('home');
    }

    // List data
    function listAvailableData(Request $request)
    {
        $seed = $request->seed ?? rand();
        $keyword = $request->keyword ?? '%';
        $page = $request->page ?? 0;

        $timestring = Carbon::now()->format('H:i:s');
        $result = User::select('t.*', 'users.*')
            ->whereNotNull('t.verified_at')
            ->where('vacation', false)
            ->where('opening_hours', '<=', $timestring)
            ->where('closing_hours', '>=', $timestring)
            ->where(function ($query) use ($keyword) {
                $query->where('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('t.expertise', 'LIKE', '%' . $keyword . '%');
            })
            ->inRandomOrder($seed)
            ->join('therapists as t', 't.user_id', '=', 'users.id')
            ->offset($page * 4)
            ->limit(4)
            ->get();

        $response = [];
        $response['seed'] = $seed;
        $response['keyword'] = $keyword;
        $response['results'] = $result;

        return response()->json($response);
    }

    // List
    function listAvailable()
    {
        return view('therapist.list');
    }
}
