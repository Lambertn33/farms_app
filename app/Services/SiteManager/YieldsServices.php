<?php

namespace App\Services\SiteManager;

use App\Models\Season;
use Illuminate\Http\Request;

class YieldsServices
{
    public function getSeasonsYields($request, $authenticatedManager)
    {
        $seasonsYields = Season::with('yields.site.manager')->with('incomes')->with('expenses')
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
}
