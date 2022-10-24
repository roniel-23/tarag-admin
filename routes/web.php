<?php

use App\Http\Controllers\PlayersController;
use App\Http\Controllers\CourtOwnersController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\GCoinTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GuestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [GuestController::class, 'index'])->name('guest');

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// })->name('guest');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/aboutus', function () {
        return Inertia::render('AboutUs');
    })->name('aboutus');

    Route::get('/users', function () {
        return Inertia::render('Users');
    })->name('users');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/transaction', [SettingsController::class, 'updateTransaction'])->name('settings.updatetransaction');
    Route::post('/settings/landing', [SettingsController::class, 'updateLandingPage'])->name('settings.updatelanding');

    Route::get('/players', [PlayersController::class, 'index'])->name('players');
    Route::get('/players/verified', [PlayersController::class, 'verifiedPlayers'])->name('players.verified');
    Route::get('/players/unverified', [PlayersController::class, 'unverifiedPlayers'])->name('players.unverified');

    Route::get('/player/{user_id}', [PlayersController::class, 'show'])->name('player.show');
    Route::post('/player/delete/{user_id}', [PlayersController::class, 'deletePlayer'])->name('player.delete');
    

    Route::get('/courtowners', [CourtOwnersController::class, 'index'])->name('courts');
    Route::get('/courtowners/verified', [CourtOwnersController::class, 'verifiedCourts'])->name('courts.verified');
    Route::get('/courtowners/unverified', [CourtOwnersController::class, 'unverifiedCourts'])->name('courts.unverified');

    Route::get('/courtowner/{user_id}', [CourtOwnersController::class, 'show'])->name('court.show');
    Route::post('/courtowner/delete/{user_id}', [CourtOwnersController::class, 'deleteCourt'])->name('court.delete');

    Route::post('/verification/player/{user_id}', [PlayersController::class, 'verifyUser']);
    Route::post('/verification/court/{user_id}', [CourtOwnersController::class, 'verifyCourt']);

    Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');

    Route::get('/gcointransaction', [GCoinTransactionController::class, 'index'])->name('gcointransaction');
    Route::post('/gcointransaction/sendtoplayer', [GCoinTransactionController::class, 'sendToPlayer'])->name('gcointransaction.sendtoplayer');
    
});

require __DIR__.'/auth.php';
