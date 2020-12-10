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
            if (User::cur()->isTherapist()) {
                return redirect()->route('therapist.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->back()->withErrors(['Kode Verifikasi Salah']);
        }
    }

    public function about() {
        return view('about');
    }
}
