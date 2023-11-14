<?php

use App\Http\Controllers\applicant_controller;
use App\Http\Controllers\dash_controller;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\events_controller;
use App\Http\Controllers\profile_controller;
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

Route::group(['prefix' => 'myevents'], function () {
    Route::post("/", [events_controller::class, "getMyEvents"]);
    Route::post("/update", [events_controller::class, "updateMyEvent"]);
});
Route::group(['prefix' => 'retrieve'], function () {
    Route::post("/", [events_controller::class, "getMainEvents"]);
    Route::post("/events/all", [events_controller::class, "getAllEvents"]);
    Route::post("/single", [events_controller::class, "getOneEvent"]);
});

Route::prefix("/events")->group(function () {
    Route::get("category/{id}", [events_controller::class, "getEventCategory"]);
    Route::post("search", [events_controller::class, "getEventSearch"]);
});
Route::post("event/apply", [events_controller::class, "applyEvents"]);
Route::post("events/approvals", [events_controller::class, "getApplicants"]);
Route::group(["prefix" => "applicant"], function () {
    Route::post("/approve", [applicant_controller::class, "approveApplicants"]);
    Route::post("/tickets", [applicant_controller::class, "retreiveTickets"]);
    Route::post("/sort_tickets", [applicant_controller::class, "sortTicket"]);
});

Route::group(["prefix" => "profile"], function () {
    Route::post("/update", [profile_controller::class, "update"]);
    Route::post("/retrieve", [profile_controller::class, "retrieve"]);
    // Route::post("/update", [profile_controller::class, "update"]);
});

Route::group(["prefix" => "dashboard"], function () {
    Route::post("/retrieve", [dash_controller::class, "openDash"]);
});

Route::prefix("/email")->group(function () {
    Route::post("verify", [EmailVerificationController::class, "send"]);
    Route::get("status", [EmailVerificationController::class, "changeStatus"]);
});
