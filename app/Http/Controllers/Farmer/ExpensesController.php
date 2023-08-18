<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Services\Farmer\ExpensesServices;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index($farm, $yield)
    {
        return (new ExpensesServices)->getYieldExpenses($yield);
    }

    public function store(Request $request, $farm, $yield)
    {
        $request->validate([
            'type' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'product' => 'required',
            'description' => 'required'
        ]);

        return (new ExpensesServices)->createYieldExpense($yield, $request);
    }
}
