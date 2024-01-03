<?php

namespace App\Http\Controllers;

use App\Http\Requests\WareRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\WareResource;
use App\Models\Ware;
use Illuminate\Http\Request;

class WareController extends Controller
{
    // create a new ware
    public function create(WareRequest $request) {
        $ware = new Ware();
        $ware->name = $request->name;
        $ware->quantity = $request->quantity;
        $ware->save();
        return WareResource::make($ware);
    }

    // get all ware
    public function index()
    {
        // get all tasks
        $wares = Ware::all();

        // return the tasks
        return WareResource::collection($wares);
    }

    // get a single ware
    public function show(Ware $ware)
    {
        // return the task
        return WareResource::make($ware);
    }

    // update a ware
    public function update(Ware $ware, WareRequest $request)
    {
        $ware->update($request->all());

        return WareResource::make($ware);
    }

    // delete a ware
    public function delete(Ware $ware)
    {
        $ware->delete();

        return response()->json(['message' => 'Ware deleted successfully'], 200);
    }





}
