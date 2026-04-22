<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\FollowUpController;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\FollowUp;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Auth + Verified)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'customersCount' => Customer::where('user_id', auth()->id())->count(),
            'dealsCount' => Deal::where('user_id', auth()->id())->count(),
            'followUpsCount' => FollowUp::where('user_id', auth()->id())
                ->where('is_done', false)
                ->count(),
        ]);
    })->name('dashboard');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/create', [CustomerController::class, 'create']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

    // Deals
    Route::get('/deals', [DealController::class, 'index']);
    Route::get('/deals/create', [DealController::class, 'create']);
    Route::post('/deals', [DealController::class, 'store']);
    Route::get('/deals/{id}/edit', [DealController::class, 'edit']);
    Route::put('/deals/{id}', [DealController::class, 'update']);
    Route::delete('/deals/{id}', [DealController::class, 'destroy']);

    // Follow Ups
    Route::get('/followups', [FollowUpController::class, 'index']);
    Route::get('/followups/create', [FollowUpController::class, 'create']);
    Route::post('/followups', [FollowUpController::class, 'store']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';