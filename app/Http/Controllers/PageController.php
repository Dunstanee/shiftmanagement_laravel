<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

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
        return view('Dashboard');  
       }
       return view('Login');
    }
    public function Checkloggins($request)
    {
        if($request->session()->has('staff'))
        {
            return 1;

        }else{
            return 0;
        }
    }
}
