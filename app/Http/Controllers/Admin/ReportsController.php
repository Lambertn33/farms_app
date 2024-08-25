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
        $sitesData = [];

        $allSites = Site::with('farms')->get();

        foreach ($allSites as $site) {
            $farms = $site->farms()->where('status', "ACCEPTED")->get();

            $siteTotalIncomes = 0;

            foreach ($farms as $farm) {
                foreach ($farm->yields as $yield) {
                    $product = $yield->pivot->product;
                    $yieldAmount = $yield->pivot->yield;

                    // Accumulate yield amounts by product name across all farms
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

                // Add the farm's total income to the site's total income
                $siteTotalIncomes += $totalIncomes;

                $farmsData[] = [
                    'farm' => $farm->name,
                    'site' => $farm->site->name,
                    'totalIncomes' => $totalIncomes,
                    'totalExpenses' => $totalExpenses,
                ];
            }

            // Add the site's data to the sitesData array
            $sitesData[] = [
                'site' => $site->name,
                'totalIncomes' => $siteTotalIncomes,
            ];
            // Process grouped data to create the final productsdata array
        }
        foreach ($groupedData as $product => $totalYield) {
            $productsdata[] = [
                'product' => $product,
                'yield' => $totalYield
            ];
        }


        // Determine the type of report to return
        if ($type === "products_report") {
            return response()->json($productsdata, 200);
        }

        if ($type === "incomes_expenses_report") {
            return response()->json($farmsData, 200);
        }

        if ($type === "sites_report") {
            return response()->json($sitesData, 200);
        }

        return response()->json(['message' => 'Invalid type'], 400);
    }
}
