<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
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
        return (new RegisterController())->register($request);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect('login')->withErrors([
                'error1' => 'Email or password not found',
            ]);
        }

        if (!User::cur()->isTherapist()) {
            Auth::logout();
            abort(403, 'Bukan terapis, silahkan login di menta.com');
        }

        return redirect()->intended('home');
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
