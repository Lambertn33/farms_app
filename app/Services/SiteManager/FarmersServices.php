<?php

namespace App\Services\SiteManager;

use App\Jobs\UserCreated;
use App\Models\Farmer;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class FarmersServices
{
    public function createUser($userObject)
    {
        $currentDateTime = now();
        $defaultPassword = $currentDateTime->format('YmdHis');
        $newUser = [
            'id' => Str::uuid()->toString(),
            'names' => $userObject->names,
            'email' => $userObject->email,
            'password' => Hash::make($defaultPassword),
            'role' => $userObject->role,
            'phone_no' => $userObject->phone_no,
            'has_confirmed_password' => false,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $newFarmer = [
            'id' => Str::uuid()->toString(),
            'user_id' => $newUser['id'],
            'created_at' => now(),
            'updated_at' => now()
        ];

        User::insert($newUser);
        Farmer::insert($newFarmer);

        UserCreated::dispatch($newUser, $defaultPassword);
        return response()->json(['message' => 'new user created successfully'], 201);
    }
}
