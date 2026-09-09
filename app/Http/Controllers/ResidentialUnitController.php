<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidentialUnitStoreRequest;
use App\Http\Resources\ResidentialUnitResource;
use App\Models\Residence;
use App\Models\ResidentialUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ResidentialUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Residence $residence)
    {
        return Inertia::render('ResidentialUnitView', [
            'residential_units' => function () use($residence) {
                $residentialUnits = ResidentialUnit::custodian()
                    ->where('residence_id', $residence->id)
                    ->with(['occupancies.user'])
                    ->paginate();

                return ResidentialUnitResource::collection($residentialUnits);
            }
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResidentialUnitStoreRequest $request, Residence $residence)
    {
        $payload = $request->validated();

        ResidentialUnit::create([
            'residence_id' => $residence->id,
            'unit_number' => $payload['unit_number'],
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ResidentialUnit $residentialUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResidentialUnit $residentialUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResidentialUnit $residentialUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResidentialUnit $residentialUnit)
    {
        //
    }
}
