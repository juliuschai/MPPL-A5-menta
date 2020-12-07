<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('home');
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
            abort(403, 'Bukan pasien, silahkan login di therapist.menta.com');
        }

        return redirect()->intended('home');
    }
}
