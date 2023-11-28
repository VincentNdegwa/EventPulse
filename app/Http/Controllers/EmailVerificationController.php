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
            "email" => "required:unique:users,email",
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
                $verificationCode = mt_rand(11111, 99999);

                $dataArray["email"] = $email;
                $dataArray["md5"] = $md5;
                $dataArray["code"] = $verificationCode;

                $emailExits = EmailVerificationModel::where("email", $email)->first();

                if ($emailExits) {
                    $insert = EmailVerificationModel::where("email", $email)->update([
                        "code" => $verificationCode,
                        "time" => now(),
                        "deadline" => now()->addDay()
                    ]);
                } else {
                    $insert = EmailVerificationModel::create([
                        "email" => $email,
                        "md5" => $md5,
                        "code" => $verificationCode,
                    ]);
                }


                if ($insert) {
                    $appUrl = env("APP_URL");
                    $link = $appUrl . "email/status?link=" . $dataArray["md5"];
                    $dataArray["link"] = $link;

                    try {
                        Mail::to($email)->send(new EmailVerificationMail($dataArray));
                        return response()->json([
                            "error" => false,
                            "message" => "Email Sent",
                            "code" => $verificationCode

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
