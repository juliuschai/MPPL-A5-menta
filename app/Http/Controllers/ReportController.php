<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function viewReport(User $user) {
        return view('report-form', compact('user'));
    }

    public function saveReport(User $user, Request $request) {
        $request->validate([
            'reason' => 'required',
        ]);

        Report::createReport($user, $request);

        return redirect()->route('user.view', ['user' => $user->id])->with('message', 'User berhasil di laporkan');
    }
}
