<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\UsersServices;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return (new UsersServices)->getUsers($request);
    }
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'names' => 'required',
            'phone_no' => 'required|unique:users|max:12|min:12',
            'email' => 'required|email|unique:users',
        ]);
        return (new UsersServices)->createUser($request);
    }
}
