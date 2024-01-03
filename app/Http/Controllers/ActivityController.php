<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // make a new activity
    public function create(ActivityRequest $request)
    {
        $activity = Activity::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);
        return ActivityResource::make($activity);
    }

    // get all activities
    public function index()
    {
        // get all activities
        $activities = Activity::all();

        // return the activities
        return ActivityResource::collection($activities);
    }

    // get a single activity
    public function show(Activity $activity)
    {
        // return the activity
        return ActivityResource::make($activity);
    }

    // update an activity
    public function update(Activity $activity, Request $request)
    {
        $activity->update($request->all());

        return ActivityResource::make($activity);
    }

    // delete an activity
    public function delete(Activity $activity)
    {
        $activity->delete();

        return response()->json(['message' => 'Activity deleted successfully'], 200);
    }




}
