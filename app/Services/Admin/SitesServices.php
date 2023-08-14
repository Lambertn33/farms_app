<?php

namespace App\Services\Admin;

use App\Models\Site;
use App\Models\SiteManager;
use Illuminate\Support\Str;

class SitesServices
{
    public function getSiteManagers()
    {
        return SiteManager::with('user')->with('sites')->get();
    }

    public function getSites()
    {
        return Site::with('manager')->with('farms')->get();
    }

    public function createSite($siteObject)
    {
        $newSite = [
            'id' => Str::uuid()->toString(),
            'name' => $siteObject->name,
            'manager_id' => $siteObject->manager_id,
            'land_type' => $siteObject->land_type,
            'size' => $siteObject->size,
            'created_at' => now(),
            'updated_at' => now()
        ];
        Site::insert($newSite);
        return response()->json(['message' => 'new site created successfully'], 201);
    }
}
