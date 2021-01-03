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
            Route::get('verify/terapis', [App\Http\Controllers\TherapistVerifyController::class, 'list'])->name('admin.verify.therapist');
            Route::get('verify/terapis/data', [App\Http\Controllers\TherapistVerifyController::class, 'listData'])->name('admin.verify.therapist.data');
            Route::get('verify/terapis/{therapist}', [App\Http\Controllers\TherapistVerifyController::class, 'view'])->name('admin.verify.therapist.view');
            Route::post('verify/terapis/{therapist}/accept', [App\Http\Controllers\TherapistVerifyController::class, 'accept'])->name('admin.verify.therapist.accept');
            Route::post('verify/terapis/{therapist}/deny', [App\Http\Controllers\TherapistVerifyController::class, 'deny'])->name('admin.verify.therapist.deny');

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

            // Transactions list
            Route::get('transaction/list/data', [App\Http\Controllers\TransactionAdminController::class, 'listData'])->name('admin.transaction.data');
            Route::get('transaction/list', [App\Http\Controllers\TransactionAdminController::class, 'list'])->name('admin.transaction.list');

            Route::get('transaction/view/{transaction}', [App\Http\Controllers\TransactionAdminController::class, 'view'])->name('admin.transaction.view');
            Route::post('transaction/accept/{transaction}', [App\Http\Controllers\TransactionAdminController::class, 'accept'])->name('admin.transaction.accept');
            Route::get('transaction/deny/{transaction}', [App\Http\Controllers\TransactionAdminController::class, 'deny'])->name('admin.transaction.deny');
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

        Route::group(['middleware' => ['auth', 'therapist', 'verified.phone']], function () {

            Route::get('verify', [App\Http\Controllers\TherapistVerifyController::class, 'show'])->name('therapist.verify');
            Route::post('verify', [App\Http\Controllers\TherapistVerifyController::class, 'save']);

            Route::get('verify/wait', [App\Http\Controllers\TherapistVerifyController::class, 'showWait'])->name('therapist.verify.wait');

            Route::group(['middleware' => ['verified.therapist']], function () {
                // Dashboard
                Route::get('home', [App\Http\Controllers\TherapistController::class, 'home'])->name('therapist.home');
                // Therapist profile
                Route::get('profile', [App\Http\Controllers\TherapistProfileController::class, 'showEdit'])->name('therapist.profile.edit');
                Route::post('profile', [App\Http\Controllers\TherapistProfileController::class, 'saveEdit']);
                Route::get('vacation/toggle', [App\Http\Controllers\TherapistProfileController::class, 'toggleVacation'])->name('therapist.vacation.toggle');

                Route::post('call/answer', [App\Http\Controllers\TransactionController::class, 'answerCall'])->name('therapist.call.answer');

                Route::post('call/finish/{transaction}', [App\Http\Controllers\TransactionController::class, 'finishCall'])->name('therapist.call.finish');
                Route::get('call/end/{transaction}', [App\Http\Controllers\TransactionController::class, 'viewEndCall'])->name('therapist.call.end');
                Route::post('call/end/{transaction}', [App\Http\Controllers\TransactionController::class, 'saveEndCall']);

                Route::get('transaction/list/data', [App\Http\Controllers\TransactionTherapistController::class, 'listData'])->name('therapist.transaction.data');
                Route::get('transaction/list', [App\Http\Controllers\TransactionTherapistController::class, 'list'])->name('therapist.transaction.list');

                Route::get('transaction/view/{transaction}', [App\Http\Controllers\TransactionTherapistController::class, 'view'])->name('therapist.transaction.view');
                Route::post('transaction/view/{transaction}', [App\Http\Controllers\TransactionTherapistController::class, 'save']);

                });
        });

    }
);


// Accessible to patient
Route::group(
    ['domain' => 'www.'.Config::get('app.base_domain')],
    function () {
        // Patient landing page
        Route::get('/', [App\Http\Controllers\PatientController::class, 'index'])->name('index');
        Route::get('about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

        Route::post('login', [App\Http\Controllers\PatientController::class, 'login']);

        Route::get('home', [App\Http\Controllers\PatientController::class, 'home'])->name('home');

        Route::group(
            ['middleware' => ['auth', 'patient', 'verified.phone']],
            function () {
                Route::get('list', [App\Http\Controllers\TherapistController::class, 'listAvailable'])->name('therapist.list');
                Route::get('list/data', [App\Http\Controllers\TherapistController::class, 'listAvailableData'])->name('therapist.list.data');

                Route::get('profile', [App\Http\Controllers\PatientController::class, 'showProfileEdit'])->name('profile.edit');
                Route::post('profile', [App\Http\Controllers\PatientController::class, 'saveProfileEdit']);

                Route::get('transaction/list/data', [App\Http\Controllers\TransactionPatientController::class, 'listData'])->name('transaction.data');
                Route::get('transaction/list', [App\Http\Controllers\TransactionPatientController::class, 'list'])->name('transaction.list');
                Route::get('transaction/view/{transaction}', [App\Http\Controllers\TransactionPatientController::class, 'view'])->name('transaction.view');
                Route::post('transaction/view/{transaction}', [App\Http\Controllers\TransactionPatientController::class, 'save']);

            }
        );
    }
);

// Login register
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('phone/change', [App\Http\Controllers\PhoneController::class, 'showEdit'])->name('phone.change');
    Route::post('phone/change', [App\Http\Controllers\PhoneController::class, 'saveEdit']);

    Route::get('phone/verify', [App\Http\Controllers\PhoneController::class, 'showVerify'])->name('phone.verify');
    Route::post('phone/verify', [App\Http\Controllers\PhoneController::class, 'verify']);

    Route::get('phone/verify/create', [App\Http\Controllers\PhoneController::class, 'createVerificationToken'])->name('phone.verify.create');

    Route::get('view/{user}', [App\Http\Controllers\UserController::class, 'showProfile'])->name('user.view');

    Route::get('chat', [App\Http\Controllers\ChatController::class, 'list'])->name('chat.list');
    Route::get('chat/{id}', [App\Http\Controllers\ChatController::class, 'view'])->name('chat.view');
    Route::post('chat/message/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');

    Route::get('chat/start/{userId}', [App\Http\Controllers\ChatController::class, 'start'])->name('chat.start');
    Route::get('chat/accept/{conversationId}', [App\Http\Controllers\ChatController::class, 'accept'])->name('chat.accept');

    Route::post('trigger/{id}', [App\Http\Controllers\ChatController::class, 'startCall'])->name('call.start');

    Route::get('report/{user}', [App\Http\Controllers\ReportController::class, 'viewReport'])->name('user.report');
    Route::post('report/{user}', [App\Http\Controllers\ReportController::class, 'saveReport']);
});
