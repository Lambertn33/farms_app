<?php

namespace App\Http\Controllers\SiteManager;

use App\Http\Controllers\Controller;
use App\Services\SiteManager\FarmsServices;
use Illuminate\Http\Request;

class FarmsController extends Controller
{
    public function show($siteId, $farmId)
    {
        return (new FarmsServices)->getFarmDetails($farmId);
    }

    public function update($siteId, $farmId, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);
        return (new FarmsServices)->approveOrRejectFarm($farmId, $request);
    }
}
