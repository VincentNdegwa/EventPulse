<?php

use App\Http\Controllers\dash_controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user_controller;
use App\Models\EmailVerificationModel;
use App\Models\events;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Inertia\Inertia;
use Mockery\Undefined;
use PhpParser\Builder\Param;

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

Route::get('/', function () {
    return Inertia::render('Home/MainPage', [
        "userId" => auth()->id(),
        "loggedIn" => auth()->check()
    ]);
});

Route::group(["middleware" => "auth"], function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard/Dashboard', [
            "userId" => auth()->id(),
        ]);
    })->name("dashboard")->middleware("auth");
    Route::get('/events', function () {
        return Inertia::render('Events/Events');
    })->name("events");

    Route::get('/my-events', function () {
        return Inertia::render('MyEvents/MyEvents');
    })->name("my-events");
    Route::get('/create', function () {
        return Inertia::render('Create/Create');
    })->name("create_event");
    Route::get('/tickets', function () {
        return Inertia::render('Tickets/Tickets');
    })->name("tickets");
    Route::get('/approvals', function () {
        return Inertia::render('Approvals/Approvals');
    })->name("approvals");


    Route::get('/profile', function () {
        return Inertia::render('Profile/Profile');
    })->name("profile");


    Route::get('/view/{id}', function ($id) {

        if ($id == null || $id == "undefined") {
            Inertia::render("Events/Events", [
                "error" => true,
                "message" => "Invalid Data"
            ]);
        } else {
            try {
                $allEvents = events::with('hosts')->where("events.id", $id)->get();
                return Inertia::render("SingleEvent/SingleEvents", [
                    "error" => false,
                    "data" => $allEvents
                ]);
            } catch (\Exception $th) {
                return Inertia::render("Events/Events", [
                    "error" => true,
                    "message" => $th->getMessage(),
                ]);
            }
        }
    })->name("getOneView");

    Route::get("/category", function (Request $request) {
        $event = events::where("category", $request->input("category"))->get();
        return Inertia::render("Events/Events", [
            "catEvents" => $event
        ]);
    })->name("category");
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name("login");

Route::get('/register', function () {
    return Inertia::render('Auth/EmailVerfication');
})->name("register");

// create_event
Route::group(['prefix' => 'user'], function () {
    Route::post('register', [user_controller::class, 'register']);
    Route::post('login', [user_controller::class, 'login']);
    Route::post('update', [user_controller::class, 'update']);
    Route::get('logout', [user_controller::class, 'logout'])->name("logout");
});

Route::post("/user-id", function () {
    $data = [
        "userId" => auth()->id()
    ];
    return response()->json($data, 200);
})->name("get-user-id");

Route::get("/email/status", function (Request $request) {

    $details = EmailVerificationModel::where("md5", $request->input("link"))->first();
    if ($details) {
        if ($details->deadline < now()) {
            return Inertia::render("Auth/EmailVerfication");
        } else {
            return Inertia::render("Auth/Register", [
                "emailProp" => $details->email
            ]);
        }
    } else {
        return Inertia::render("Auth/Components/TokenExpired");
    }
    return response()->json([
        "data" => $request->input("link")
    ]);
});
