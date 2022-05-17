<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Groups()
    {
        $data = Employee::all();
        return $data;
    }
}
