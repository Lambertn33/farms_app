<?php

namespace App\Services\Farmer;

use App\Models\Farm_Season;
use App\Models\Farm_Season_Expense;
use Illuminate\Support\Str;

class ExpensesServices
{
    public function getYieldExpenses($yieldId)
    {
        $yieldExpenses = Farm_Season::with('expenses')->find($yieldId);
        return response()->json($yieldExpenses, 200);
    }

    public function createYieldExpense($yieldId, $request)
    {
        $newYieldExpense = [
            'id' => Str::uuid()->toString(),
            'yield_id' => $yieldId,
            'type' => $request->type,
            'product' => $request->product,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Farm_Season_Expense::insert($newYieldExpense);
        return response()->json(['message' => 'new expense created successfuly'], 201);
    }
}
