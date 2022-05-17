<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Humanresource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function NewCompany()
    {
        $data = Company::all()->first();
        if(!empty($data))
        {
            return redirect('/');  
        }
        return view('Company');
    }
    public function EmployeeSms(Request $request)
    {
        
        if(self::Checkloggins($request) == 1)
        {
            $data = Employee::all();
            $count = Employee::all()->count();
            $SMScounts = Message::all()->count();
            
            return view('SmS_Employee',['Employees'=>$data,'EmployeesNo'=>$count,'SmsNo'=>$SMScounts]);  
        }
        return redirect('/');
    }
    public function Signout(Request $request)
    {
        
        if(self::Checkloggins($request) == 1)
        {
            $request->session()->forget('staff');  
            $request->session()->forget('company');  
            return redirect('/');
        }
        return redirect('/');
    }
    public function Staff(Request $request)
    {
        
        if(self::Checkloggins($request) == 1)
        {
            $data = Humanresource::all();
            $count = Humanresource::all()->count();
            
            return view('Staff',['Staffs'=>$data,'StaffNo'=>$count]);  
        }
        return redirect('/');
    }
    public function login()
    {
        $data = Company::all()->first();
        if(empty($data))
        {
            return redirect('Company');  
        }
        return view('Login',['Company'=> $data]);
    }
    public function Dashboard(Request $request)
    {
        if(self::Checkloggins($request) == 1)
       {
           $data_employee_count = Employee::all()->count();
           $data_resource_count = Humanresource::all()->count();
           $average = round($data_employee_count/2);
        return view('Dashboard',['EmployeeNo'=> $data_employee_count,'AverageEmpl'=>$average,'ResourceNo'=>$data_resource_count]);  
       }
       return redirect('/');
    }
    public function NewEmployee(Request $request)
    {
        if(self::Checkloggins($request) == 1)
       {
        $gender  = Gender::all();
        return view('New_Employee',['Gender'=>$gender]);  
       }
       return redirect('/');
    }
    public function Employee(Request $request)
    {
        if(self::Checkloggins($request) == 1)
       {
           $data  = Employee::all();
        return view('Employee',['Employees'=> $data]);  
       }
       return redirect('/');
    }
    public function EditEmployee(Request $request,$id)
    {
        if(self::Checkloggins($request) == 1)
       {
           $data  = Employee::find($id);
           $gender  = Gender::all();
        return view('Edit_Employee',['Employees'=> $data,'Gender'=>$gender]);  
       }
       return redirect('/');
    }
    public function NewStaff(Request $request)
    {
        if(self::Checkloggins($request) == 1)
       {
           
           $gender  = Gender::all();
        return view('New_Staff',['Gender'=>$gender]);  
       }
       return redirect('/');
    }
    public function Checkloggins($request)
    {
        if($request->session()->has('staff') && $request->session()->has('company'))
        {
            return 1;

        }else{
            return 0;
        }
    }
}
