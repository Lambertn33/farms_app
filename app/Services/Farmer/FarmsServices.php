<?php

namespace App\Services\Farmer;

use App\Models\Farm;
use Illuminate\Support\Str;

class FarmsServices
{

    public function getMyFarms($user)
    {
        // return $user->farms()->get();
        $userFarms = $user->farms()->get();
        $userTotalSize = $user->farms()->sum('size');
        return [$userFarms, $userTotalSize];
    }

    public function createNewFarm($farmObject, $farmerId)
    {
        $newFarm = [
            'id' => Str::uuid()->toString(),
            'site_id' => $farmObject->site_id,
            'farmer_id' => $farmerId,
            'name' => $farmObject->name,
            'farm_number' => $farmObject->farm_number,
            'status' => Farm::PENDING,
            'size' => $farmObject->size,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Farm::insert($newFarm);
        return response()->json(['message' => 'new farm created successfully'], 201);
    }
}
