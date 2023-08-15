<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\YieldsServices;
use Illuminate\Http\Request;

class YieldsController extends Controller
{
    public function index(Request $request)
    {
        return (new YieldsServices)->getSeasonsYields($request);
    }
}
