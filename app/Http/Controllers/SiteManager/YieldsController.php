<?php

namespace App\Http\Controllers\SiteManager;

use App\Http\Controllers\Controller;
use App\Services\SiteManager\YieldsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YieldsController extends Controller
{
    private $authenticatedManager;

    public function __construct() {
        $this->authenticatedManager = Auth::user()->manager;
    }
    public function index(Request $request)
    {
        return (new YieldsServices)->getSeasonsYields($request, $this->authenticatedManager);
    }
}
