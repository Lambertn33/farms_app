<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Services\Farmer\IncomesServices;
use Illuminate\Http\Request;

class IncomesController extends Controller
{
    public function index($farm, $yield)
    {
        return (new IncomesServices)->getYieldIncomes($yield);
    }

    public function store(Request $request, $farm, $yield)
    {
        $request->validate([
            'type' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        return (new IncomesServices)->createYieldIncome($yield, $request);
    }
}
