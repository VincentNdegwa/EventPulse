<?php

namespace App\Http\Controllers;

use App\Models\eventApplication;
use App\Models\events;
use App\Models\host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $myevents = events::where('creator_id', $userId)->orderBy("events.created_at", "desc")->with("hosts")->get();

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

    function getAllEvents()
    {
        try {
            $categories = DB::table("category")->get();
            $allEvents = events::with('hosts')->orderBy("events.created_at", "desc")->get();
            return response()->json([
                "error" => false,
                "data" => $allEvents,
                "categories" => $categories
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => $th->getMessage()
            ]);
        }
    }

    function getOneEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eventId' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid input data',
            ], 400);
        }
        try {
            $eventId = $request->input("eventId");
            $allEvents = events::with('hosts')->where("events.id", $eventId)->get();
            return response()->json([
                "error" => false,
                "data" => $allEvents
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => $th->getMessage()
            ]);
        }
    }


    function applyEvents(Request $request)
    {

        // return response()->json($request);
        $validate = Validator::make($request->all(), [
            "user_id" => "required",
            "event_id" => "required",
            "event_agenda" => "required",
            "expectation" => "required",
            "similar_event" => "required",
        ]);
        if ($validate->fails()) {
            return response()->json([
                "error" => true,
                "message" => "Invalid Data",
                "errors" => $validate->errors()
            ]);
        } else {

            try {
                $event = events::find($request->input("event_id"));
                if (!$event) {
                    return response()->json([
                        "error" => true,
                        "message" => "Event not found",
                    ]);
                };
                if ($event->creator_id == $request->input("user_id")) {
                    return response()->json([
                        "error" => true,
                        "message" => "You cannot apply for an event that is yours"
                    ]);
                } else {
                    $eventApp = eventApplication::where("user_id", $request->input("user_id"))->Where("event_id", $request->input("event_id"))->first();
                    if ($eventApp) {
                        return response()->json([
                            "error" => true,
                            "message" => "You have already applied for this Event"
                        ]);
                    } else {
                        try {

                            eventApplication::create([
                                'user_id' => $request->input('user_id'),
                                'event_id' => $request->input('event_id'),
                                "event_agenda" => $request->input("event_agenda"),
                                "expectation" => $request->input("expectation"),
                                "similar_event" => $request->input("similar_event"),
                            ]);
                            return response()->json([
                                "error" => false,
                                "message" => "Application successful",
                            ]);
                        } catch (\Exception $th) {
                            return response()->json([
                                "error" => true,
                                "message" => $th->getMessage()
                            ]);
                        }
                    }
                }
            } catch (\Exception $th) {
                return response()->json([
                    "error" => true,
                    "message" => $th->getMessage()
                ]);
            }
        }
    }


    function getApplicants(Request $request)
    {
        try {
            $events = events::whereIn('events.id', function ($query) use ($request) {
                $query->select('events.id')
                    ->from('events')
                    ->join('event_application', 'events.id', '=', 'event_application.event_id')
                    ->where('events.creator_id', $request->input('user_id'))
                    ->where('event_application.status', 'pending')
                    ->distinct();
            })->with(['eventApplicants', 'eventApplicants.user'])
                ->get();


            return response()->json([
                "error" => false,
                "data" => $events
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                'data' => $th->getMessage(),
            ]);
        }
    }


    function getEventCategory($id)
    {
        try {
            if ($id != "All") {
                $event = events::where("category", $id)->with('hosts')->orderBy("events.created_at", "desc")->get();
                return response()->json([
                    "error" => false,
                    "data" => $event
                ]);
            } else {
                $event = events::with('hosts')->orderBy("events.created_at", "desc")->get();
                return response()->json([
                    "error" => false,
                    "data" => $event
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => "Failed to get events"
            ]);
        }
    }
}
