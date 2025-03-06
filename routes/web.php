<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\PengetahuanController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ScreeningController;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/home', function () {
    return view('home');
})->name("home");

Route::get('/register', function () {
    return view('auth.register');
})->name("register");

Route::get('/hasil', function () {
    return view('hasil');
})->name("hasil");

Route::get('/result', function () {
    return view('result');
})->name("result");

Route::get('/screening', [ScreeningController::class, 'index'])->name('screening')->middleware('verified');
Route::post('/hasil', [ScreeningController::class, 'hasil_konsultasi'])->name('hasil_konsultasi')->middleware('verified');
Route::get('/riwayat', [PageController::class, 'riwayat'])->name('riwayat')->middleware('verified');
Route::get('/result/{id}', [ScreeningController::class, 'get_result_pdf'])->name('get_hasil_konsultasi')->middleware('verified');
Route::get('/result-normal', [ScreeningController::class, 'generate_normal_result'])->name('get_normal_result')->middleware('verified');
Route::get('/hasil/{id}', [ScreeningController::class, 'get_hasil_konsultasi'])->name('get_konsultasi')->middleware('verified');
Route::get('/save-hasil/{id}/{name}', [ScreeningController::class, 'save_hasil'])->name('save_hasil')->middleware('verified');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [PageController::class, 'admin'])->name('home');
    Route::resource('pengguna', AnggotaController::class);
    Route::resource('gejala', GejalaController::class);
    Route::resource('pengetahuan', PengetahuanController::class);
    Route::resource('penyakit', PenyakitController::class);
});


// Email Verification Route
Route::get('/email/verify', function () {
    $user = Auth::user();

    if ($user->email_verified_at) {
        return redirect('/home')->with("success", "Email sudah diverifikasi sebelumnya.");
    }

    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    // Check if email is already verified
    if ($user->hasVerifiedEmail()) {
        return redirect('/home')->with("success", "Email sudah diverifikasi sebelumnya.");
    }

    // Validate the hash
    if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        abort(403, 'Token tidak valid');
    }

    // Mark email as verified
    $user->markEmailAsVerified();
    event(new Verified($user));

    return redirect('/home')->with("success", "Email berhasil diverifikasi!");
})->middleware('signed')->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi berhasil dikirimkan!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// forgot password
Route::get('/forgot-password', [ForgotPasswordController::class, "forgotPassword"])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, "sendResetEmail"])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, "resetPassword"])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, "submitResetPassword"])->middleware('guest')->name('password.update');
