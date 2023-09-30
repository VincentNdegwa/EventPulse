<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dash_controller extends Controller
{
    public function openDash(Request $request)
    {
        // $user_d = $request->input("id");
        // if (auth()->id() == $user_d) {
        //     dd($user_d);
        // }
        dd(Auth::user());
    }
}
