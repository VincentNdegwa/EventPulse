<?php

namespace App\Http\Controllers;

use App\Models\eventApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class applicant_controller extends Controller
{
    public function approveApplicants(Request $results)
    {
        DB::beginTransaction();
        try {
            foreach ($results->applicants as $applicant) {
                $status = $applicant["state"] ? "approved" : "rejected";
                eventApplication::where("event_id", $results->input("event_id"))
                    ->where("user_id", $applicant["applicant_id"])
                    ->update(["status" => $status]);
            }
            DB::commit();
            return response()->json([
                "error" => false,
                "message" => "Approved applicants"
            ]);
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json([
                "error" => true,
                "message" => $th->getMessage()
            ]);
        }

        return response()->json($results);
    }

    public function retreiveTickets(Request $request)
    {
        try {
            $ticket = eventApplication::where("user_id", $request->input("user_id"))->with("event")->get();
            if ($ticket) {
                return response()->json([
                    "error" => false,
                    "data" => $ticket
                ]);
            } else {
                return response()->json([
                    "error" => true,
                    "message" => "Failed to retrieve"
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => $th->getMessage()
            ]);
        }
    }
}
