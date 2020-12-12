<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneVerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function showEdit()
    {
        return view('phone.change');
    }

    public function saveEdit(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $user = User::cur();
        $user->phone_num = $request->phone;
        $user->verified_at = null;
        $user->save();

        $user->createVerificationToken();
        return redirect()->route('phone.verify');
    }

    public function showVerify()
    {
        return view('phone.verify');
    }

    public function verify(PhoneVerificationRequest $request)
    {
        $ret = User::cur()->verifyPhone($request->code);
        if ($ret) {
            if (User::cur()->isTherapist()) {
                return redirect()->route('therapist.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()
                ->back()
                ->withErrors(['Kode Verifikasi Salah']);
        }
    }

    public function createVerificationToken()
    {
        User::cur()->createVerificationToken();

        return redirect()->back();
    }
}
