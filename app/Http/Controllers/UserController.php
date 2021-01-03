<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function listData()
    {
        $model = (new User())->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function list()
    {
        return view('admin.user.list');
    }

    public function block(User $user)
    {
        $user->block();

        return redirect()->route('admin.user.list')->with('message', 'User berhasil diblokir');
    }

    public function unblock(User $user)
    {
        $user->unblock();

        return redirect()->route('admin.user.list')->with('message', 'User berhasil dibebaskan');
    }

    public function showProfile(User $user)
    {
        if ($user->isTherapist()) {
            return view('therapist.profile.view', compact('user'));
        } else if ($user->isPatient()) {
            return view('profile.view', compact('user'));
        }
    }
}
