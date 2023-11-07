<?php

namespace App\Http\Controllers;

use App\Models\userProfile;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class profile_controller extends Controller
{
    // first_name: "",
    // last_name: "",
    // phone_number: "",
    // country: "",
    // state: "",
    // profile_image: ""
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "last_name" => "required",
            "phone_number" => "required",
            "country" => "required",
            "state" => "required",
            "first_name" => "required",
            "user_id" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => true,
                "message" => "All fields required"
            ]);
        } else {
            if ($request->input("profile_image")) {
                $file = $request->input("profile_image");
                $binaryImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));
                $filesName = "profile" . time() . ".jpg";
                Storage::disk("public")->put($filesName, $binaryImageData);
                $url = Storage::url($filesName);

                $existingImageUrl = userProfile::where("user_profile_id", $request->input("user_id"))
                    ->value("profile_image");

                if ($existingImageUrl != "") {
                    Storage::disk("public")->delete($existingImageUrl);
                }

                $profile =  userProfile::where("user_profile_id", $request->input("user_id"))->update([
                    "last_name" => $request->input("last_name"),
                    "phone_number" => $request->input("phone_number"),
                    "country" => $request->input("country"),
                    "state" => $request->input("state"),
                    "first_name" => $request->input("first_name"),
                    "profile_image" => $url
                ]);

                if ($profile) {
                    return response()->json([
                        "error" => false,
                        "message" => "Profile Updated"
                    ]);
                } else {
                    return response()->json([
                        "error" => true,
                        "message" => "Failed to update profile"
                    ]);
                }
            } else {
                $profile =  userProfile::where("user_profile_id", $request->input("user_id"))->update([
                    "last_name" => $request->input("last_name"),
                    "phone_number" => $request->input("phone_number"),
                    "country" => $request->input("country"),
                    "state" => $request->input("state"),
                    "first_name" => $request->input("first_name"),
                ]);

                if ($profile) {
                    return response()->json([
                        "error" => false,
                        "message" => "Profile Updated"
                    ]);
                } else {
                    return response()->json([
                        "error" => true,
                        "message" => "Failed to update profile"
                    ]);
                }
            }
        }
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
