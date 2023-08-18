<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Services\Farmer\YieldsServices;
use Illuminate\Http\Request;

class YieldsController extends Controller
{
    public function create()
    {
        return (new YieldsServices)->getAvailableSeasons();
    }
    public function store(Request $request, $farmId)
    {
        $request->validate([
            'season' => 'required|exists:seasons,id',
            'year' => 'required',
            'product' => 'required'
        ]);

        return (new YieldsServices)->createFarmYield($farmId, $request);
    }
    public function show($id)
    {
        return (new YieldsServices)->getFarmYields($id);
    }
}
