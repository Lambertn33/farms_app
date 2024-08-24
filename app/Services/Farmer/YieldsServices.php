<?php

namespace App\Services\Farmer;

use App\Models\Farm;
use App\Models\Season;
use Illuminate\Support\Str;

class YieldsServices
{
    public function getAvailableSeasons()
    {
        $seasons = Season::get();
        return response()->json($seasons, 200);
    }
    public function getFarmYields($farmId)
    {
        $farmYields = Farm::with('yields')->find($farmId);
        return response()->json($farmYields, 200);
    }

    public function createFarmYield($farmId, $request)
    {
        $farm = Farm::find($farmId);
        $season = Season::find($request->season);
        $farm->yields()->attach($season, [
            'id' => Str::uuid()->toString(),
            'year' => $request->year,
            'yield' => $request->yield ? $request->yield : 0,
            'product' => $request->product,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response()->json(['message' => 'New yield of season ' . $season->season . ' and farm ' . $farm->name . ' has been created successfully '], 200);
    }

    public function updateFarmYield($farmId, $request)
    {
        $farm = Farm::find($farmId);
        $season = Season::find($request->seasonId);
    
        // Check if the specific pivot record exists using the yield ID
        $pivotRecord = $farm->yields()->wherePivot('id', $request->yieldId)
                                      ->wherePivot('season_id', $request->seasonId)
                                      ->first();
    
        if ($pivotRecord) {
            // Update the existing pivot record
            $farm->yields()->updateExistingPivot($seasonId, [
                'yield' => $request->yield ? $request->yield : 0,
                'updated_at' => now()
            ], false);
    
            return response()->json(['message' => 'Yield of season ' . $season->season . ' for farm ' . $farm->name . ' has been updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Yield record not found'], 404);
        }
    }
}
