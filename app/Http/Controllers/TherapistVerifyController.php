<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TherapistVerifyController extends Controller
{
    public function viewVerify()
    {
        return view('therapist.verify.form');
    }

    public function saveVerify(Request $request)
    {
        $request->validate([
            'dokumen' => 'required|mimes:pdf,jpeg,jpg,png',
        ]);

        User::cur()->therapist->saveDokumenFromRequest($request);
        return redirect()->route('therapist.verify.wait');
    }

    public function viewVerifyWait() {
        $therapist = User::cur()->therapist;
        if ($therapist->isVerified()) {
            return redirect()->route('therapist.home');
        }
        if (!$therapist->dokumenExists()) {
            return redirect()->route('therapist.verify');
        }

        return view('therapist.verify.wait');
    }

    // Admin functions
    public function listVerifyTherapist()
    {
        return view('admin.verify.therapist');
    }

    public function listVerifyTherapistData()
    {
        $model = Therapist::join('users as u', 'therapists.user_id', '=', 'u.id')
            ->whereNull('therapists.verified_at')
            ->select(['u.*', 'therapists.*'])
            ->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function viewVerifyTherapist(Therapist $therapist)
    {
        return view('admin.verify.view', compact('therapist'));
    }

    public function verifyTherapistAccept(Therapist $therapist)
    {
        $therapist->verified_at = now();
        $therapist->save();

        return redirect()->route('admin.verify.therapist');
    }

    public function verifyTherapistDeny(Therapist $therapist)
    {
        $therapist->dokumen_file = null;
        $therapist->save();

        return redirect()->route('admin.verify.therapist');
    }
}
