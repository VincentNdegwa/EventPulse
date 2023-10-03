<?php

use App\Http\Controllers\events_controller;
use App\Http\Controllers\user_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// mobile enpoints
Route::group(['prefix' => 'user'], function () {
    Route::post('register', [user_controller::class, 'register']);
    Route::post('login', [user_controller::class, 'login']);
    Route::post('update', [user_controller::class, 'update']);
});


Route::post("/create-event", [events_controller::class, "createEvent"]);
Route::post("/get-events", [events_controller::class, "getMyEvents"]);
Route::group(['prefix' => 'retrieve'], function () {
    Route::post("/events/all", [events_controller::class, "getAllEvents"]);
    Route::post("/single", [events_controller::class, "getOneEvent"]);
});
