<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;

class FarmersController extends Controller
{
    public function index()
    {
        $farmers = Farmer::with('user')->with('farms')->get();
        return response()->json($farmers, 200);
    }

    public function show($farmerId)
    {
        $farmer = Farmer::with('user')->with('farms')->find($farmerId);
        return response()->json($farmer, 200);
    }
}
