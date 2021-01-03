<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function listData()
    {
        $model = Report::join('users as u', 'u.id', '=', 'reports.user_id')
                ->join('users as r', 'r.id', '=', 'reports.reported_user_id')
                ->select([
                    'reports.id',
                    'reports.reported_user_id',
                    'u.name as userName',
                    'r.name as reportedName',
                    'r.email as reportedEmail',
                    'r.phone_num as reportedPhoneNum',
                    'r.role as reportedRole',
                    'reports.reason',
                    'r.blocked_at',
                ])->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function list()
    {
        return view('admin.report.list');
    }

    public function viewForm(User $user) {
        return view('report-form', compact('user'));
    }

    public function save(User $user, Request $request) {
        $request->validate([
            'reason' => 'required',
        ]);

        Report::createReport($user, $request);

        return redirect()->route('user.view', ['user' => $user->id])->with('message', 'User berhasil di laporkan');
    }
}
