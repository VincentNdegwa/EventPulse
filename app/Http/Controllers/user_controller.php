<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class user_controller extends Controller
{
    // register
    // login
    // update
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => "required|string|max:100",
            'email' => "required|string|unique:users|max:100",
            'password' => "required|string|min:2",
            'passwordConf' => "required|string|same:password",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => true,
                "message" => "Validation failed",
                "errors" => $validator->errors(),
            ]);
        } else {
            try {
                $user =  users::create([
                    "username" => $request->input("username"),
                    "email" => $request->input("email"),
                    "password" => Hash::make($request->input("password")),
                ]);

                if ($user) {
                    return response()->json([
                        "error" => false,
                        "message" => "User created successfully!",
                        "data" => $user
                    ]);
                } else {
                    return response()->json([
                        "error" => true,
                        "message" => "User creation failed",
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    "error" => true,
                    "message" => $e->getMessage(),
                ]);
            }
        }
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => true, "message" => "validation error", "errors" => $validator->errors()]);
        } else {

            try {
                $attempt = Auth::attempt([
                    "email" => $request->input("email"),
                    "password" => $request->input("password")

                ]);
                if ($attempt) {
                    Session::start();

                    if (Auth::check()) {
                        return response()->json([
                            "error" => false,
                            "message" => 'Login successful',
                            "data" => Auth::user(),
                        ]);
                    }
                } else {
                    return response()->json([
                        "error" => true,
                        "message" => 'Invalid Cedentials',
                    ]);
                }
            } catch (\Exception $th) {
                return response()->json([
                    "error" => true,
                    "message" => $th->getMessage(),
                ]);
            }
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
