<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Site;
use App\Services\Farmer\FarmsServices;
use Illuminate\Support\Facades\Auth;

class FarmsController extends Controller
{
    private $authenticatedFarmer;

    public function __construct()
    {
        $this->authenticatedFarmer = Auth::user()->farmer;
    }
    public function index()
    {
        $authenticatedFarmer = $this->authenticatedFarmer;
        $farms = (new FarmsServices)->getMyFarms($authenticatedFarmer);
        return response()->json($farms, 200);
    }

    public function create()
    {
        $sites = Site::get();
        return response()->json($sites, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'farm_number' => 'required|unique:farms',
            'site_id' => 'required|exists:sites,id',
            'size' => 'required'
        ]);

        return (new FarmsServices)->createNewFarm($request, $this->authenticatedFarmer->id);
    }
}
