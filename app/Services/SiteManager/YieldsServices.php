<?php

namespace App\Services\SiteManager;

use App\Models\Farm_Season;
use App\Models\Season;
use Illuminate\Http\Request;

class YieldsServices
{
    public function getSeasonsYields($request, $authenticatedManager)
    {
        $seasonsYields = Season::with('yields.site.manager')
            ->when($request->query('season'), function ($query, $seasonId) {
                return $query->whereHas('yields', function ($subQuery) use ($seasonId) {
                    $subQuery->where('season_id', $seasonId);
                });
            })
            ->when($request->query('year'), function ($query, $year) {
                return $query->whereHas('yields', function ($subQuery) use ($year) {
                    $subQuery->where('year', $year);
                });
            })
            ->whereHas('yields.site.manager', function ($managerQuery) use ($authenticatedManager) {
                $managerQuery->where('id', $authenticatedManager->id);
            })
            ->get();
        return response()->json($seasonsYields, 200);
    }

    public function getYieldIncomesAndExpenses($yield)
    {
        return Farm_Season::with('incomes')->with('expenses')->find($yield);
    }
}
