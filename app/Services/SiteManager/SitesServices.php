<?php

namespace App\Services\SiteManager;

use App\Models\Site;

class SitesServices
{
    public function getMySites($authenticatedManager)
    {
        $sites = $authenticatedManager->sites()->get();
        return response()->json($sites, 200);
    }

    public function getSiteFarms($siteId, $request)
    {
        $status = $request->input('status');
        $site = Site::with('farms')->find($siteId);
        $siteFarms =  $site->farms()->get();
        if ($status) {
           $siteFarms = $site->farms->where('status', $status);
        }
        return response()->json($siteFarms, 200);
    }
}
