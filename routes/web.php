<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// therapists routes
Route::group(
    ["domain" => "therapist." . Config::get("app.base_domain")],
    function () {
        // Landing page
        Route::get("/", [App\Http\Controllers\TherapistController::class, "index"])->name("therapist.index");

        // Registration
        Route::get("register", [App\Http\Controllers\TherapistController::class, "showRegister"])->name("therapist.register");
        Route::post("register", [App\Http\Controllers\TherapistController::class, "register"]);

        // Login
        Route::post("login", [App\Http\Controllers\TherapistController::class, "login"]);

        Route::group(["middleware" => ["auth", "therapist"]], function () {
            // Dashboard
            Route::get("home", [App\Http\Controllers\TherapistController::class, "home"])->name("therapist.home");
        });
    }
);

Route::group(
    ["domain" => "admin." . Config::get("app.base_domain")],
    function () {
        // Login
        Route::post("login", [App\Http\Controllers\AdminController::class, "login"]);

        Route::group(["middleware" => ["auth", "admin"]], function () {
            // Dashboard
            Route::get("home", [App\Http\Controllers\AdminController::class, "home"])->name("admin.home");
        });
    }
);

Route::group(
    ["domain" => Config::get("app.base_domain")],
    function () {
        // Patient landing page
        Route::get("/", [App\Http\Controllers\PatientController::class, "index"])->name("index");

        Route::post("login", [App\Http\Controllers\PatientController::class, "login"]);

        Route::get("home", [App\Http\Controllers\PatientController::class, "home"])->name("home");
    }
);

// Login register
Auth::routes();

