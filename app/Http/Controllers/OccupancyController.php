<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupancyStoreRequest;
use App\Models\Occupancy;
use App\Models\Occupant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OccupancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OccupancyStoreRequest $request)
    {
        DB::transaction(function () use($request) {
            $payload = $request->validated();
            $residentialUnitId = $payload['residential_unit_id'];

            Occupancy::where('residential_unit_id', $residentialUnitId)
                ->where('deleted_at', null)
                ->delete();

            $occupant = $request->attributes->get('user');

            Occupancy::create([
                'user_id' => $occupant->id,
                'residential_unit_id' => $residentialUnitId,
            ]);
        });

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Occupant $occupant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Occupant $occupant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Occupant $occupant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Occupant $occupant)
    {
        //
    }
}
