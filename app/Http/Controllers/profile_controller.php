<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class profile_controller extends Controller
{
    public function update(Request $request)
    {
    }


    public function retrieve(Request $request)
    {
        $user = users::where("id", $request->input("user_id"))->with("profile")->first();

        if ($user) {
            return response()->json([
                "error" => false,
                "data" => $user
            ]);
        } else {
            return response()->json([
                "error" => true,
                "message" => "An error occured",
            ]);
        }
    }
}
