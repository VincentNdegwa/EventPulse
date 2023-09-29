<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return Inertia::render('Home/MainPage');
});
Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name("login");
Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->name("register");
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Dashboard');
})->name("dashboard");
Route::get('/events', function () {
    return Inertia::render('Events/Events');
})->name("events");

Route::get('/my-events', function () {
    return Inertia::render('MyEvents/MyEvents');
})->name("my-events");
