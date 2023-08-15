<?php

namespace App\Services;

use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
    public function login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Invalid provided credentials'], 401);
        }
        return $this->createNewToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out'], 200);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,

        ]);
    }
    
    public function updatePassword($data)
    {
        $user = User::where('email', $data->email)->first();
        $checkPassowrd = Hash::check($data->old_password, $user->password);
        if ($checkPassowrd) {
            $newPassword = $data->new_password;
            $user->update([
                'password' => Hash::make($newPassword),
                'has_confirmed_password' => true
            ]);
            return response()->json(['message' => 'Password changed successfully'], 200);
        } else {
            return response()->json(['message' => 'Invalid old password provided'], 400);
        }
    }
}
