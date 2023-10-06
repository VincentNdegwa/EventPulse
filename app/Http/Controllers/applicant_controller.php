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
}
