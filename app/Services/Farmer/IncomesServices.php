<?php

namespace App\Services\Farmer;

use App\Models\Farm_Season;
use App\Models\Farm_Season_Income;
use Illuminate\Support\Str;

class IncomesServices
{
    public function getYieldIncomes($yieldId)
    {
        $yieldIncomes = Farm_Season::with('incomes')->find($yieldId);
        return response()->json($yieldIncomes, 200);
    }

    public function createYieldIncome($yieldId, $request)
    {
        $newYieldIncome = [
            'id' => Str::uuid()->toString(),
            'yield_id' => $yieldId,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Farm_Season_Income::insert($newYieldIncome);
        return response()->json(['message' => 'new income created successfuly'], 201);
    }
}
