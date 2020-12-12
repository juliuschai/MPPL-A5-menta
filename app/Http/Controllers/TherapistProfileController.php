<?php

namespace App\Http\Controllers;

use App\Http\Requests\TherapistProfileRequest;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Http\Request;

class TherapistProfileController extends Controller
{
    public function showEdit()
    {
        $user = User::cur();

        return view('therapist.profile.edit', compact('user'));
    }

    public function saveEdit(TherapistProfileRequest $request)
    {
        $user = User::cur();
        if ($request->profilePic)
        {
            $user->saveProfilePic($request);
        }

        $user->therapist->saveProfile($request);

        return redirect()->back();
    }

    public function toggleVacation()
    {
        $therapist = User::cur()->therapist;

        $therapist->vacation = !$therapist->vacation;
        $therapist->save();

        return redirect()->back();
    }
}
