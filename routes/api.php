<?php

use App\Http\Controllers\PlayersAddressApiController;
use App\Http\Controllers\CourtsAddressApiController;
use App\Http\Controllers\VerificationApiController;
use App\Http\Controllers\PlayersApiController;
use App\Http\Controllers\CourtDataApiController;
use App\Http\Controllers\RoomPlayersApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/address', [PlayersAddressApiController::class, 'index']);
Route::get('/player/address/{user_id}', [PlayersAddressApiController::class, 'showAddressByPlayer']);
Route::get('/court/address/{user_id}', [CourtsAddressApiController::class, 'showAddressByCourt']);

Route::get('/players', [VerificationApiController::class, 'showVerifiedPlayers']);
Route::get('/courts', [VerificationApiController::class, 'showVerifiedCourts']);

Route::get('/courtdata/{id}', [CourtDataApiController::class, 'getCourtData']);

Route::get('/roomplayers/{id}', [RoomPlayersApiController::class, 'getRoomPlayers']);

Route::get('/user/{user_id}', [VerificationApiController::class, 'getUserName']);

Route::get('/data', [VerificationApiController::class, 'getData']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

