<?php

namespace App\Services\SiteManager;

use App\Jobs\FarmApprovedOrRejected;
use App\Models\Farm;

class FarmsServices
{
    public function getFarmDetails($farmId)
    {
        $farm = Farm::with('farmer.user')->with('site')->find($farmId);
        return response()->json($farm, 200);
    }

    public function approveOrRejectFarm($farmId, $request)
    {
        $farm = Farm::with('farmer.user')->with('site')->find($farmId);
        $status = $request->status;
        $farmOwner = $farm->farmer->user;
        $farm->update([
            'status' => $status
        ]);
        FarmApprovedOrRejected::dispatch($farm, $status, $farmOwner);
        return response()->json(['message' => 'farm status updated successfully'], 200);
    }
}
