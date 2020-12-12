<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about()
    {
        return view('about');
    }
}
