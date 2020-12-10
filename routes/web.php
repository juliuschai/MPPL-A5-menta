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

// Admin routes
Route::group(
    ['domain' => 'admin.' . Config::get('app.base_domain')],
    function () {
        // Login
        Route::post('login', [App\Http\Controllers\AdminController::class, 'login']);

        Route::group(['middleware' => ['auth', 'admin']], function () {
            // Dashboard
            Route::get('home', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.home');

            // Verify terapis
            Route::get('verify/terapis', [App\Http\Controllers\TherapistVerifyController::class, 'listVerifyTherapist'])->name('admin.verify.therapist');
            Route::get('verify/terapis/data', [App\Http\Controllers\TherapistVerifyController::class, 'listVerifyTherapistData'])->name('admin.verify.therapist.data');
            Route::get('verify/terapis/{therapist}', [App\Http\Controllers\TherapistVerifyController::class, 'viewVerifyTherapist'])->name('admin.verify.therapist.view');
            Route::post('verify/terapis/{therapist}/accept', [App\Http\Controllers\TherapistVerifyController::class, 'verifyTherapistAccept'])->name('admin.verify.therapist.accept');
            Route::post('verify/terapis/{therapist}/deny', [App\Http\Controllers\TherapistVerifyController::class, 'verifyTherapistDeny'])->name('admin.verify.therapist.deny');

            // Lihat pasien blokir
            Route::get('pasien', [App\Http\Controllers\UserController::class, 'listPatient'])->name('admin.patient');
            Route::get('pasien/data', [App\Http\Controllers\UserController::class, 'listPatientData'])->name('admin.patient.data');

            // Lihat terapis blokir
            Route::get('terapis', [App\Http\Controllers\UserController::class, 'listTherapist'])->name('admin.therapist');
            Route::get('terapis/data', [App\Http\Controllers\UserController::class, 'listTherapistData'])->name('admin.therapist.data');

            // Lihat terapis blokir
            Route::get('artikel', [App\Http\Controllers\ArticleController::class, 'listArticle'])->name('admin.article');
            Route::get('artikel/data', [App\Http\Controllers\ArticleController::class, 'listArticleData'])->name('admin.article.data');

            // To Delete
            Route::get('users', [App\Http\Controllers\UserController::class, 'list'])->name('admin.users');
            Route::get('users/data', [App\Http\Controllers\UserController::class, 'listData'])->name('admin.users.data');
            Route::get('user/{user}', [App\Http\Controllers\UserController::class, 'view'])->name('admin.user.view');
        });
    }
);

// therapists routes
Route::group(
    ['domain' => 'terapis.' . Config::get('app.base_domain')],
    function () {
        // Landing page
        Route::get('/', [App\Http\Controllers\TherapistController::class, 'index'])->name('therapist.index');

        // Registration
        Route::post('register', [App\Http\Controllers\TherapistController::class, 'register']);

        // Login
        Route::post('login', [App\Http\Controllers\TherapistController::class, 'login']);

        Route::group(['middleware' => ['auth', 'therapist']], function () {

            Route::get('verify', [App\Http\Controllers\TherapistVerifyController::class, 'viewVerify'])->name('therapist.verify');
            Route::post('verify', [App\Http\Controllers\TherapistVerifyController::class, 'saveVerify']);

            Route::get('verify/wait', [App\Http\Controllers\TherapistVerifyController::class, 'viewVerifyWait'])->name('therapist.verify.wait');

            Route::group(['middleware' => ['verified.therapist']], function () {
                // Dashboard
                Route::get('home', [App\Http\Controllers\TherapistController::class, 'home'])->name('therapist.home');
                // Therapist profile
                Route::get('profile', [App\Http\Controllers\TherapistController::class, 'viewEditProfile'])->name('therapist.profile.edit');
                Route::post('profile', [App\Http\Controllers\TherapistController::class, 'saveEditProfile']);

            });
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
                Route::get('list/data', [App\Http\Controllers\TherapistController::class, 'listData'])->name('therapist.list');
            }
        );
    }
);

// Login register
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('phone/verify', [App\Http\Controllers\HomeController::class, 'showVerifyPhone'])->name('verify.phone');
    Route::post('phone/verify', [App\Http\Controllers\HomeController::class, 'verifyPhone']);

    Route::get('phone/verify/create', [App\Http\Controllers\UserController::class, 'createVerificationToken'])->name('verify.phone.create');
});
