<?php

namespace App\Services\Admin;

use App\Jobs\UserCreated;
use App\Models\Farmer;
use App\Models\SiteManager;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersServices
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
        $newSiteManager = [
            'id' => Str::uuid()->toString(),
            'user_id' => $newUser['id'],
            'created_at' => now(),
            'updated_at' => now()
        ];

        $newFarmer = [
            ...$newSiteManager,
            'DOB' => $userObject->DOB,
            'gender' => $userObject->gender,
            'marital_status' => $userObject->marital_status,
            'family_members' => $userObject->family_members
        ];
        User::insert($newUser);

        if ($userObject->role === User::SITE_MANAGER) {
            SiteManager::insert($newSiteManager);
        }

        if ($userObject->role === User::FARMER) {
            Farmer::insert($newFarmer);
        }

        UserCreated::dispatch($newUser, $defaultPassword);
        return response()->json(['message' => 'new user created successfully'], 201);
    }
}
