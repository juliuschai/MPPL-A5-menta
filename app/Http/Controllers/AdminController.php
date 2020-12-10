<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home');
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

        if (!User::cur()->isAdmin()) {
            Auth::logout();
            abort(403, 'Bukan admin, silahkan login di menta.com');
        }

        return redirect()->intended('home');
    }
}
