<?php

namespace App\Http\Controllers\SiteManager;

use App\Http\Controllers\Controller;
use App\Services\Admin\UsersServices;
use Illuminate\Http\Request;

class FarmersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            //users field
            'names' => 'required',
            'phone_no' => 'required|unique:users|max:12|min:12',
            'email' => 'required|email|unique:users',
            'DOB' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'family_members' => 'required'
        ]);

        return (new UsersServices)->createUser($request);
    }
}
