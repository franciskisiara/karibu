<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitStoreRequest;
use App\Http\Requests\VisitUpdateRequest;
use App\Http\Resources\VisitResource;
use App\Mail\VisitorInvited;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('VisitView', [
            'visits' => function () {
                $visits = Visit::whereHas(
                    'occupancy.residentialUnit.residence.custodians',
                    function ($query) {
                        $query->where('custodians.user_id', Auth::id());
                    }
                )   ->with([
                        'visitor',
                        'occupancy.residentialUnit.residence',
                    ])
                    ->latest()
                    ->paginate();

                return VisitResource::collection($visits);
            }
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitStoreRequest $request)
    {
        DB::transaction(function () use($request) {
            $passcode = rand(1000, 9999);

            $visitor = $request->attributes->get('visitor');
            $occupancy = $request->attributes->get('occupancy');

            $residentialUnit = $occupancy->residentialUnit;

            Visit::create([
                'occupancy_id' => $occupancy->id,
                'visitor_id' => $visitor->id,
                'passcode' => $passcode,
            ]);

            $message = 'You have been invited by '. $request->user()->name . ' to ' . $residentialUnit->residence->name . ' - ' . $residentialUnit->unit_number . '. Your code is ' . $passcode;

            Mail::to($visitor)->send(new VisitorInvited($message));
        });

        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitUpdateRequest $request, Visit $visit)
    {
        $visit->update(['welcomed_at' => now()]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        //
    }
}
