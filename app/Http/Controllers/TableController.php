<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function GetEmployees()
    {
        $data  = Employee::all();
        return view('DataTables.EmployeeTable',['Employees'=> $data]); 
    }
    public function GetEmployeesSms()
    {
        $data  = Employee::all();
        return view('DataTables.EmployeeSmS',['Employees'=> $data]); 
    }
    public function GetComposeSms()
    {
        $data  = Employee::all();
        return view('DataTables.ComposeSms',['Employees'=> $data]); 
    }
    public function GetMessages()
    {
        
        $sms = DB::table('messages')
        ->orderBy('created_at', 'desc')
        ->get();
        foreach ($sms as  $item) {
            $users = json_decode($item->sent_to,true);
            
            $item->employee_count = count($users);
            $item->employees = DB::table('employees')
                                ->whereIn('id',$users)
                                ->select('first_name','last_name')
                                ->get(); 
            
        }
        return view('DataTables.Messages',['Messages'=> $sms]); 
    }
}
