<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Admin\UsersServices;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'names' => 'required',
            'phone_no' => 'required|unique:users|max:12|min:12',
            'email' => 'required|email|unique:users',
             //farmers fields
            'DOB' => 'sometimes|required',
            'gender' => 'sometimes|required',
            'marital_status' => 'sometimes|required',
            'family_members' => 'sometimes|required'
        ]);
        return (new UsersServices)->createUser($request);
    }
}
