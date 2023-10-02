<?php

namespace App\Http\Controllers;

use App\Models\events;
use App\Models\host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class events_controller extends Controller
{
    function createEvent(Request $request)
    {
        try {
            $event_image = $request->input("event_image");
            $binaryImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $event_image));
            $fileName = "event" . time() . ".jpg";
            Storage::disk("public")->put($fileName, $binaryImageData);
            $url = Storage::url($fileName);

            $event = events::create([
                "title" => $request->input("title"),
                "description" => $request->input("description"),
                "deadline_application" => $request->input("deadline_application"),
                "event_date" => $request->input("event_date"),
                "category" => $request->input("category"),
                "venue" => $request->input("venue"),
                "price" => $request->input("price"),
                "creator_id" => $request->input("creator_id"),
                "address" => $request->input("address"),
                "age_limit" => $request->input("age_limit"),
                "meeting_link" => $request->input("meeting_link"),
                "event_image" => $url,
            ]);
            $readyHost = [];
            if ($event) {
                $hostArray = $request->input("hostArray");
                $hostIndex = 0;
                foreach ($hostArray as $host) {
                    $hostImage = $host["profile_image"];
                    $binaryImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $hostImage));
                    $fileName = "host-" . $hostIndex . time() . ".jpg";
                    Storage::disk("public")->put($fileName, $binaryImageData);
                    $url = Storage::url($fileName);

                    $host = host::create([
                        "profile_image" => $url,
                        "host_event_id" => $event->id,
                        "host_name" => $host["host_name"],
                        "host_email" => $host["host_email"],
                        "host_occupation" => $host["host_occupation"],
                        "host_social" => $host["host_social"],
                    ]);
                    $readyHost[] = $host;
                    $hostIndex++;
                }
                return response()->json([
                    "error" => false,
                    "event" => $event,
                    "host" => $host
                ]);
            } else {
                return response()->json([
                    "error" => true,
                    "message" => "Event creation failed",
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => $th->getMessage(),
            ]);
        }
    }
    function getMyEvents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid input data',
            ], 400);
        }

        try {
            $userId = $request->input('userId');
            $myevents = events::where('creator_id', $userId)->get();

            return response()->json([
                'error' => false,
                'data' => $myevents,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
