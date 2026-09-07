<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidenceStoreRequest;
use App\Http\Resources\ResidenceResource;
use App\Models\Residence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ResidenceView', [
            'residences' => function () {
                $residences = Residence::whereHas('custodians', function ($query) {
                    $query->where('custodians.user_id', Auth::id());
                })->paginate();

                return ResidenceResource::collection($residences);
            }
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResidenceStoreRequest $request)
    {
        DB::transaction(function () use($request) {
            $data = $request->validated();

            $residence = Residence::create([
                'name' => $data['name']
            ]);

            $residence->custodians()->attach(Auth::id());
        });

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Residence $residence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residence $residence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Residence $residence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Residence $residence)
    {
        //
    }
}
