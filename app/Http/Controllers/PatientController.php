<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientProfileRequest;
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

    public function showProfileEdit()
    {
        $user = User::cur();

        return view('profile.edit', compact('user'));
    }

    public function saveProfileEdit(PatientProfileRequest $request)
    {
        $user = User::cur();
        if ($request->profilePic)
        {
            $user->saveProfilePic($request);
        }

        $user->saveProfile($request);

        return redirect()->back();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->remember)) {
            return redirect('login')->withErrors(['Email or password not found']);
        }

        if (!User::cur()->isPatient()) {
            Auth::logout();
            abort(403, 'Bukan pasien, silahkan login di terapis.menta.com');
        }

        return redirect()->intended('home');
    }
}
