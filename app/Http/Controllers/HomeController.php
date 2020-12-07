<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneVerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showVerifyPhone()
    {
        return view('verify.phone');
    }

    public function verifyPhone(PhoneVerificationRequest $request)
    {
        $ret = User::cur()->verifyPhone($request->code);
        if ($ret) {
            return redirect()->with('error', 'wrong phone code');
        } else {
            return redirect()->route('home');
        }
    }

    public function about() {
        return view('about');
    }
}
