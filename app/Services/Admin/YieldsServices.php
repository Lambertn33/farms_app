<?php

namespace App\Services\Admin;

use App\Models\Farm_Season;
use App\Models\Season;
use Illuminate\Http\Request;

class YieldsServices
{
    public function getSeasonsYields($request)
    {
        $seasonsYields = Season::with('yields')
            ->when($request->query('season'), function ($query, $seasonId) {
                return $query->whereHas('yields', function ($subQuery) use ($seasonId) {
                    $subQuery->where('season_id', $seasonId);
                });
            })
            ->get();
        return response()->json($seasonsYields, 200);
    }

    public function getYieldIncomesAndExpenses($yield)
    {
        return Farm_Season::with('incomes')->with('expenses')->find($yield);
    }
}
