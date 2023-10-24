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
    function getMainEvents(Request $request)
    {
        try {
            $date = now()->toDateString();
            $latestEvents = events::with('hosts')
                ->orderBy("events.created_at", "desc")
                ->whereDate("events.deadline_application", ">=", $date)
                ->limit(20)
                ->get();
            $recomendedEvents = events::with("hosts")
                ->withCount("eventApplicants")
                ->whereDate("events.deadline_application", ">=", $date)
                ->limit(20)
                ->orderBy("event_applicants_count", "DESC")
                ->get();
            $upcomingEvents = events::with("hosts")
                ->withCount("eventApplicants")
                ->whereDate("events.event_date", ">=", now()->addDays(2)->toDateString())
                ->whereDate("events.event_date", "<=", now()->addDays(8)->toDateString())
                ->limit(20)
                ->orderBy("event_applicants_count", "DESC")
                ->get();

            return response()->json([
                "error" => false,
                "latestEvents" => $latestEvents,
                "recomendedEvents" => $recomendedEvents,
                "upCommingEvents" => $upcomingEvents,
                "day" => $date
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => $th->getMessage()
            ]);
        }
    }

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
        if ($request->input("userId") && !$request->input("category") && !$request->input("search")) {
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
                $categories = DB::table("category")->get();
                $myevents = events::where('creator_id', $userId)->orderBy("events.created_at", "desc")->with("hosts")->withCount("eventApplicants")->get();

                return response()->json([
                    'error' => false,
                    'data' => $myevents,
                    "categories" => $categories

                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage(),
                ], 500);
            }
        } elseif ($request->input("search")) {
            try {
                $userId = $request->input('userId');
                $categories = DB::table("category")->get();
                $myevents = events::where('creator_id', $userId)
                    ->where(function ($query) use ($request) {
                        $search = "%" . $request->input("search") . "%";
                        $query->orWhere("title", "LIKE", $search)
                            ->orWhere("description", "LIKE", $search)
                            ->orWhere("category", "LIKE", $search)
                            ->orWhere("venue", "LIKE", $search)
                            ->orWhere("address", "LIKE", $search);
                    })
                    ->orderBy("events.created_at", "desc")
                    ->with("hosts")
                    ->get();

                return response()->json([
                    "error" => false,
                    "data" => $myevents,
                    "res" => $request->input("search")
                ]);

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
        } elseif ($request->input("category")) {
            $id = $request->input("category");
            $userId = $request->input('userId');
            try {
                if ($id != "All") {
                    $event = events::where("category", $id)->with('hosts')->where('creator_id', $userId)->orderBy("events.created_at", "desc")->get();
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


    function getEventSearch(Request $request)
    {
        try {
            $events = events::where(function ($query) use ($request) {
                $search = "%" . $request->input("search") . "%";
                $query->orWhere("title", "LIKE", $search)
                    ->orWhere("description", "LIKE", $search)
                    ->orWhere("category", "LIKE", $search)
                    ->orWhere("venue", "LIKE", $search)
                    ->orWhere("address", "LIKE", $search);
            })->get();

            return response()->json([
                "error" => false,
                "data" => $events,
                "res" => $request->input("search")
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "error" => true,
                "message" => "Failed to get events",
                "ex" => $th->getMessage()
            ]);
        }
    }

    function updateMyEvent(Request $request)
    {
        DB::beginTransaction();

        $updatedStatus = true;
        $message = "";
        try {
            if (preg_match('/^data/', $request->input("event_image"))) {
                $filePath = events::select("event_image")->where("id", $request->input("id"))->get();
                Storage::disk("public")->delete($filePath);

                $binaryImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input("event_image")));
                $fileName = "event" . time() . ".jpg";
                Storage::disk("public")->put($fileName, $binaryImageData);
                $url = Storage::url($fileName);

                $updated = events::where("id", $request->input("id"))->update([
                    "title" => $request->input("title"),
                    "description" => $request->input("description"),
                    "deadline_application" => $request->input("deadline_application"),
                    "event_date" => $request->input("event_date"),
                    "venue" => $request->input("venue"),
                    "address" => $request->input("address"),
                    "meeting_link" => $request->input("meeting_link"),
                    "event_image" => $url,
                ]);
                if (!$updated) {
                    $updatedStatus = false;
                    $message = "Failed to update events with new barners";
                }
            } else {
                $updated = events::where("id", $request->input("id"))->update([
                    "title" => $request->input("title"),
                    "description" => $request->input("description"),
                    "deadline_application" => $request->input("deadline_application"),
                    "event_date" => $request->input("event_date"),
                    "venue" => $request->input("venue"),
                    "address" => $request->input("address"),
                    "meeting_link" => $request->input("meeting_link"),
                ]);
                if (!$updated) {
                    $updatedStatus = false;
                    $message = "Failed to update events";
                }
            }
            $hostIndex = 0;
            $hostsWithIds = [];
            $hostsWithoutIds = [];
            $hostsRemoved = [];
            foreach ($request->input("hosts") as $host) {
                if (isset($host["id"])) {
                    $hostsWithIds[] = $host;
                } else {
                    $hostsWithoutIds[] = $host;
                }
            }
            // get the count of the hosts in that event
            $initialHostCount = host::where("host_event_id", $request->input("id"))->get();
            if (count($hostsWithIds) >= count($initialHostCount)) {
                foreach ($hostsWithIds as $host) {
                    if (
                        preg_match('/^data/', $request->input("profile_image"))
                    ) {
                        $profilePath = host::select("profile_image")->where("id", $request->input("id"))->get();
                        Storage::disk("public")->delete($profilePath);

                        $binaryImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input("event_image")));
                        $fileName = "host-" . $hostIndex . time() . ".jpg";
                        Storage::disk("public")->put($fileName, $binaryImageData);
                        $url = Storage::url($fileName);

                        $hostUpdate =  host::where("id", $host["id"])->update([
                            "host_name" => $host["host_name"],
                            "host_email" => $host["host_email"],
                            "host_occupation" => $host["host_occupation"],
                            "host_social" => $host["host_social"],
                            "profile_image" => $url
                        ]);
                        $hostIndex++;
                        if (!$hostUpdate) {
                            $updatedStatus = false;
                            $message = "Failed to update the hosts with new profile";
                        }
                    } else {
                        $hostUpdate =  host::where("id", $host["id"])->update([
                            "host_name" => $host["host_name"],
                            "host_email" => $host["host_email"],
                            "host_occupation" => $host["host_occupation"],
                            "host_social" => $host["host_social"],
                        ]);
                        if (!$hostUpdate) {
                            $updatedStatus = false;
                            $message = "Failed to update host";
                        }
                    }
                }
            } else {
                foreach ($initialHostCount as $existHost) {
                    $found = false;
                    foreach ($hostsWithIds as $host) {
                        if ($host["id"] == $existHost->id) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $hostsRemoved[] = $existHost->id;
                    }
                }
                foreach ($hostsRemoved as $hostId) {
                    $deletedHosts = host::findOrFail($hostId)->delete();
                }
            }

            foreach ($hostsWithoutIds as $host) {
                $hostImage = $host["profile_image"];
                $binaryImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $hostImage));
                $fileName = "host-" . $hostIndex . time() . ".jpg";
                Storage::disk("public")->put($fileName, $binaryImageData);
                $url = Storage::url($fileName);

                $host = host::create([
                    "profile_image" => $url,
                    "host_event_id" => $request->input("id"),
                    "host_name" => $host["host_name"],
                    "host_email" => $host["host_email"],
                    "host_occupation" => $host["host_occupation"],
                    "host_social" => $host["host_social"],
                ]);
                $hostIndex++;

                if (!$host) {
                    $updatedStatus = false;
                    $message = "Failed to create the new Host";
                }
            }

            if ($updatedStatus) {
                DB::commit();
                return response()->json([
                    "error" => false,
                    "data" => $updated
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    "error" => true,
                    "message" => $message,
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
