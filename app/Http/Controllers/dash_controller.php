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
                $event = events::inRandomOrder()->with("hosts")->where("creator_id", "!=", request()->input("user_id"))->first();
                $tickets = eventApplication::where("user_id", $request->input("user_id"))
                    ->where("status", "approved")
                    ->orderBy("updated_at", "DESC")
                    ->with("event")
                    ->limit(3)
                    ->get();

                $eventsAttended = eventApplication::where("user_id", $request->input("user_id"))->where("status", "passed")->count();
                $eventsCreated = events::where("creator_id", request()->input("user_id"))->count();
                $eventsApplied = eventApplication::where("user_id", $request->input("user_id"))->count();

                $eventApplicants = events::where("deadline_application", '>=', now()->setTimezone("UTC")->toDateString())
                    ->where("creator_id", $request->input("user_id"))
                    ->withCount("eventApplicants")
                    ->get();


                return response()->json([
                    "error" => false,
                    "randomEvent" => $event,
                    "userTickets" => $tickets,
                    "eventsAttended" => $eventsAttended,
                    "eventsCreated" => $eventsCreated,
                    "eventsApplied" => $eventsApplied,
                    "eventApplicants" => $eventApplicants,
                    "DATE" => now()->setTimezone("UTC")->toDateString()
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
