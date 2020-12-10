<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
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

    // Start CRUD users
    public function view(User $user)
    {
        return view('admin.user.view', compact('user'));
    }

    public function createVerificationToken()
    {
        User::cur()->createVerificationToken();

        return redirect()->back();
    }
}
