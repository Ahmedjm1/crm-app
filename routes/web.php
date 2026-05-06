<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\Auth\FirebaseAuthController;

use App\Models\Customer;
use App\Models\Deal;
use App\Models\FollowUp;

/*
|--------------------------------------------------------------------------
| Firebase Auth Routes
|--------------------------------------------------------------------------
*/

Route::post('/firebase-register', [FirebaseAuthController::class, 'register']);
Route::post('/firebase-login', [FirebaseAuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Logout (Firebase session logout)
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {

    session()->forget('firebase_user');
    session()->forget('firebase_id_token');

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Email Verification (Firebase)
|--------------------------------------------------------------------------
*/

Route::post('/email/verification-notification', function () {

    Http::post(
        'https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key=' . env('FIREBASE_API_KEY'),
        [
            'requestType' => 'VERIFY_EMAIL',
            'idToken' => session('firebase_id_token'),
        ]
    );

    return back()->with('status', 'verification-link-sent');
})->name('verification.send');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('welcome'));

/*
|--------------------------------------------------------------------------
| Firebase Protected Routes (NO Laravel auth middleware)
|--------------------------------------------------------------------------
*/

Route::middleware('firebase.auth')->group(function () {

    Route::get('/dashboard', function () {

        return view('dashboard', [
            'customersCount' => Customer::count(),
            'dealsCount' => Deal::count(),
            'followUpsCount' => FollowUp::where('is_done', false)->count(),
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
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
});