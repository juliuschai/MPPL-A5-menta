<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

// therapists routes
Route::group(
    ['domain' => 'therapist.' . Config::get('app.base_domain')],
    function () {
        // Landing page
        Route::get('/', [App\Http\Controllers\TherapistController::class, 'index'])->name('therapist.index');

        // Registration
        Route::post('register', [App\Http\Controllers\TherapistController::class, 'register']);

        // Login
        Route::post('login', [App\Http\Controllers\TherapistController::class, 'login']);

        Route::group(['middleware' => ['auth', 'therapist']], function () {
            // Dashboard
            Route::get('home', [App\Http\Controllers\TherapistController::class, 'home'])->name('therapist.home');
        });
    }
);

Route::group(
    ['domain' => 'admin.' . Config::get('app.base_domain')],
    function () {
        // Login
        Route::post('login', [App\Http\Controllers\AdminController::class, 'login']);

        Route::group(['middleware' => ['auth', 'admin']], function () {
            // Dashboard
            Route::get('home', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.home');

            Route::get('users', [App\Http\Controllers\UserController::class, 'list'])->name('admin.users');
            Route::get('users/data', [App\Http\Controllers\UserController::class, 'listData'])->name('admin.users.data');
            Route::get('user/{user}', [App\Http\Controllers\UserController::class, 'view'])->name('admin.user.view');
            Route::post('user/{user}/email/verify', [App\Http\Controllers\UserController::class, 'verifyEmail'])->name('admin.user.email.verify');
        });
    }
);

// Accessible to patient
Route::group(
    ['domain' => Config::get('app.base_domain')],
    function () {
        // Patient landing page
        Route::get('/', [App\Http\Controllers\PatientController::class, 'index'])->name('index');
        Route::get('about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

        Route::post('login', [App\Http\Controllers\PatientController::class, 'login']);

        Route::get('home', [App\Http\Controllers\PatientController::class, 'home'])->name('home');

        Route::group(
            ['middleware' => ['verified.phone']],
            function () {
                Route::get('list', [App\Http\Controllers\TherapistController::class, 'list'])->name('therapist.list');
                Route::get('listdata', [App\Http\Controllers\TherapistController::class, 'listData'])->name('therapist.list');
            }
        );
    }
);

// Login register
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('phone/verify', [App\Http\Controllers\HomeController::class, 'showVerifyPhone'])->name('verify.phone');
    Route::post('phone/verify', [App\Http\Controllers\HomeController::class, 'verifyPhone'])->name('verify.phone');

    Route::get('phone/verify/create', [App\Http\Controllers\UserController::class, 'createVerificationToken'])->name('verify.phone.create');
});
