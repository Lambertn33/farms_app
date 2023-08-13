<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SitesServices;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function index()
    {
        return (new SitesServices)->getSites();
    }

    public function create()
    {
        return (new SitesServices)->getSiteManagers();
    }

    public function store(Request $request)
    {
        $request->validate([
            'manager_id' => 'required',
            'size' => 'required',
            'land_type' => 'required',
        ]);

        return (new SitesServices)->createSite($request);
    }
}
