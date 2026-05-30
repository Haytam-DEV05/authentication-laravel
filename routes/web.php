<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ForgetPasswordController;

Route::get('/', [AuthController::class, 'login'])->name("users.login");
Route::post('/', [AuthController::class, 'auth'])->name("users.auth");

Route::get('/register', [AuthController::class, 'register'])->name('users.register');
Route::post('/register', [AuthController::class, 'store'])->name('users.store');

Route::get('/admin/users/{id}', [AdminController::class, 'show'])->middleware(['auth', 'admin'])->name('admin.showUser');
Route::patch('/admin/users/{id}', [AdminController::class, 'updatePassword'])->middleware(['auth', 'admin'])->name('admin.editUser');
Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->middleware(['auth', 'admin'])->name('admin.deleteUser');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('users.logout');

    Route::get('/Dashboard', function () {
        return view('user.dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/admin', function () {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    })->middleware(['admin', 'verified'])->name('admin.dashboard');

    // USERS =>
    Route::resource('/Dashboard/users', UserController::class)->middleware('verified');
    Route::patch('/Dashboard/users/{id}/editImage', [UserController::class, 'AddImage'])
        ->middleware('verified')
        ->name('users.editImage');
    Route::patch('/Dashboard/users/{id}/addPhoneNumber', [UserController::class, 'addPhoneNumber'])
        ->middleware('verified')
        ->name('users.addPhoneNumber');
});


// EMAIL VERIFICATION =>
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:5,2'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/Dashboard');
})->middleware(['auth'])->name('verification.verify');



// FORGET PASSWORD =>
Route::get('/forget-password', [ForgetPasswordController::class, 'ViewforgetPassword'])->name('users.view-forget-password');
Route::post('/forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('users.forget-password');
// Verification dyal Code =>
Route::get('/verify-code/{email}', [ForgetPasswordController::class, 'viewVerifyCode'])->name('users.view-verify-code');
Route::post('/verify-code', [ForgetPasswordController::class, 'verifyCode'])->name('users.verify-code');
// Reset password =>
Route::get('/reset-password/{email}', [ForgetPasswordController::class, 'viewResetPassword'])->name('users.view-rest-password');
Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword'])->name('users.reset-password');
