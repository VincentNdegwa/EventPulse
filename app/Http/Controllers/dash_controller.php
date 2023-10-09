<?php

namespace App\Http\Controllers;

use App\Models\eventApplication;
use App\Models\events;
use App\Models\userProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class dash_controller extends Controller
{
    public function openDash(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "user_id" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "error" => true,
                    "message" => "UserId not provided",
                    "user_id" => $request->input("user_id")
                ]);
            } else {
                $categories = DB::table("category")->get();
                $event = events::inRandomOrder()->first();
                $tickets = eventApplication::where("user_id", $request->input("user_id"))
                    ->where("status", "approved")
                    ->orderBy("updated_at", "DESC")
                    ->with("event")
                    ->limit(3)
                    ->get();
                $recommended = [];
                $userdetails = userProfile::where("user_profile_id", $request->input("user_id"))->first();

                if ($userdetails) {
                    if ($userdetails->country) {
                        $recommended = events::where("address", 'LIKE', '%' . $userdetails->country . '%')
                            ->where("id", '!=', $event->id)
                            ->inRandomOrder()
                            ->limit(3)
                            ->get();
                    } else {
                        $recommended = events::where("creator_id", '!=', $request->input("user_id"))
                            ->inRandomOrder()
                            ->limit(3)
                            ->get();
                    }
                }

                return response()->json([
                    "error" => false,
                    "categories" => $categories,
                    "randomEvent" => $event,
                    "userTickets" => $tickets,
                    "recommendedEvents" => $recommended,
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
