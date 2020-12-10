<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\TherapistProfileRequest;
use App\Models\Therapist;
use App\Models\User;
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
            abort(403, 'Bukan terapis, silahkan login di menta.com');
        }

        return redirect()->intended('home');
    }

    public function viewEditProfile()
    {
        return view('therapist.profileEdit');
    }

    public function saveEditProfile(TherapistProfileRequest $request)
    {

    }

    // List data
    function listData()
    {
        $model = (new User())->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    // List
    function list()
    {
        return view('therapist.list');
    }
}
