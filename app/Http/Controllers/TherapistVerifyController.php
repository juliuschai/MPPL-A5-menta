<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TherapistVerifyController extends Controller
{
    public function show()
    {
        return view('therapist.verify.form');
    }

    public function save(Request $request)
    {
        $request->validate([
            'expertise' => 'required|string',
            'document' => 'required|mimes:pdf,jpeg,jpg,png',
        ]);

        $therapist = User::cur()->therapist;
        $therapist->saveVerify($request);
        return redirect()->route('therapist.verify.wait');
    }

    public function showWait() {
        $therapist = User::cur()->therapist;
        if ($therapist->isVerified()) {
            return redirect()->route('therapist.home');
        }
        if (!$therapist->documentExists()) {
            return redirect()->route('therapist.verify');
        }

        return view('therapist.verify.wait');
    }

    // Admin functions
    public function list()
    {
        return view('admin.verify.therapist');
    }

    public function listData()
    {
        $model = Therapist::join('users as u', 'therapists.user_id', '=', 'u.id')
            ->whereNull('therapists.verified_at')
            ->select(['u.*', 'therapists.*'])
            ->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function view(Therapist $therapist)
    {
        return view('admin.verify.view', compact('therapist'));
    }

    public function accept(Therapist $therapist)
    {
        $therapist->verified_at = now();
        $therapist->save();

        return redirect()->route('admin.verify.therapist');
    }

    public function deny(Therapist $therapist)
    {
        $therapist->document_file = null;
        $therapist->verified_at = null;
        $therapist->save();

        return redirect()->route('admin.verify.therapist');
    }
}
