<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', [AuthController::class, 'login'])->name("users.login");
Route::post('/', [AuthController::class, 'auth'])->name("users.auth");

Route::get('/register', [AuthController::class, 'register'])->name('users.register');
Route::post('/register', [AuthController::class, 'store'])->name('users.store');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('users.logout');

    Route::get('/Dashboard', function () {
        return view('dashboard');
    })->middleware(['user', 'verified'])->name('dashboard');

    Route::get('/admin', function () {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    })->middleware('admin')->name('admin.dashboard');
});



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
