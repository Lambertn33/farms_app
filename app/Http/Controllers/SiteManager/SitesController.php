<?php

namespace App\Http\Controllers\SiteManager;

use App\Http\Controllers\Controller;
use App\Services\SiteManager\SitesServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    private $authenticatedManager;

    public function __construct()
    {
        $this->authenticatedManager = Auth::user()->manager;
    }

    public function index()
    {
        return (new SitesServices)->getMySites($this->authenticatedManager);
    }

    public function show($siteId, Request $request)
    {
        return (new SitesServices)->getSiteFarms($siteId, $request);
    }
}
