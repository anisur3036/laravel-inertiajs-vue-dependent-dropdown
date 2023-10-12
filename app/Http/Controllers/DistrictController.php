<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        return inertia('District', [
            'district' => District::all(),
        ]);
    }
}
