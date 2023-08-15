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
            'year' => $request->year,
            'yield' => $request->yield,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response()->json(['message' => 'New yield of season ' . $season->season . ' and farm ' . $farm->name . ' has been created successfully '], 200);
    }
}
