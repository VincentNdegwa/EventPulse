<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationMail;
use App\Models\EmailVerificationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailVerificationController extends Controller
{
    public function send(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => "required|unique:email_verification,email|unique:users,email",
        ]);

        if ($validator->fails()) {

            return response()->json([
                "error" => true,
                "message" => "Email exist please sign in"
            ]);
        } else {

            $dataArray = [];
            if ($request->has('email')) {
                $md5 = md5($request->input("email"));
                $email = $request->input("email");

                $dataArray["email"] = $email;
                $dataArray["md5"] = $md5;


                $insert = EmailVerificationModel::create([
                    "email" => $email,
                    "md5" => $md5
                ]);

                if ($insert) {
                    $appUrl = env("APP_URL");
                    $link = $appUrl . "email/status?link=" . $dataArray["md5"];
                    $dataArray["link"] = $link;

                    try {
                        Mail::to($email)->send(new EmailVerificationMail($dataArray));
                        return response()->json([
                            "error" => false,
                            "message" => "Email Sent"
                        ]);
                    } catch (\Exception $th) {
                        return response()->json(['error' => true, 'message' => $th->getMessage()]);
                    }
                } else {
                    return response()->json([
                        "error" => true,
                        "message" => "Error inserting"
                    ]);
                }
            } else {
                return response()->json([
                    "error" => true,
                    "message" => "No Email Sent"
                ]);
            }
        }
    }

    public function changeStatus(Request $request)
    {
        
    }
}
