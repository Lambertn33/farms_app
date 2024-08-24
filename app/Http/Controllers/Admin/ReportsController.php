<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farm_Season;
use App\Models\Site;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index($type)
    {
        $productsdata = [];
        $groupedData = [];
        $farmsData = [];

        $allSites = Site::with('farms')->get();
        foreach ($allSites as $site) {
            $farms = $site->farms()->where('status', "ACCEPTED")->get();

            foreach ($farms as $farm) {
                foreach ($farm->yields as $yield) {
                    $product = $yield->pivot->product;
                    $yieldAmount = $yield->pivot->yield;

                    if (!isset($groupedData[$product])) {
                        $groupedData[$product] = 0;
                    }

                    $groupedData[$product] += $yieldAmount;
                }

                $yieldIncomes = Farm_Season::with('incomes', 'expenses')
                    ->where('farm_id', $farm->id)
                    ->get();

                $totalIncomes = 0;
                $totalExpenses = 0;

                foreach ($yieldIncomes as $yieldIncome) {
                    // Sum all incomes for the farm
                    foreach ($yieldIncome->incomes as $income) {
                        $totalIncomes += $income->quantity * $income->price;
                    }

                    // Sum all expenses for the farm
                    foreach ($yieldIncome->expenses as $expense) {
                        $totalExpenses += $expense->quantity * $expense->price;
                    }
                }

                $farmsData[] = [
                    'farm' => $farm->name,
                    'totalIncomes' => $totalIncomes,
                    'totalExpenses' => $totalExpenses,
                ];
            }

            foreach ($groupedData as $product => $totalYield) {
                $productsdata[] = [
                    'product' => $product,
                    'yield' => $totalYield
                ];
            }

            // return $type === "products_reports" ? $productsdata : $farmsData;
            if ($type === "products_report") {
                return response()->json($productsdata, 200);
            }

            if ($type === "incomes_expenses_report") {
                return response()->json($farmsData, 200);
            }

            return response()->json(['message' => 'invalid type'], 400);
        }
    }
}
