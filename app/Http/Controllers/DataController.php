<?php

namespace App\Http\Controllers;

use App\Models\Humanresource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function NewCompany(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'company_name'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);
        if($validation->passes())
        {
                $image = $request->file('image');
                $new_name = date("Ymd").''.rand() . '.' . $image->getClientOriginalExtension();
            if($file = $request->hasFile('image')) 
            {
                if($request->input('password') == $request->input('password_confirmation'))
                {
                    $id = DB::table('companies')->insertGetId([
                   'company_name'=>$request->input('company_name'),
                   'city'=>$request->input('city'),
                   'email'=>$request->input('email'),
                   'contact'=>$request->input('contact'),
                   'tag'=>$request->input('tag'),
                   'logo'=>$new_name,
                   'address'=>$request->input('address'),
                    ]);
                    $query = DB::table('humanresources')->insertGetId([
                   'first_name'=>'Admin',
                   'last_name'=>'Admin',
                   'email'=>$request->input('email'),
                   'contact'=>$request->input('contact'),
                   'company_id'=>$id,
                   'role'=>1,
                   'password'=>Hash::make($request->input('password')),
                    ]);
                    if($query) 
                    {
                        $destinationPath = public_path().'/logos' ;
                        $image->move($destinationPath,$new_name);
                        return array('status'=> 200, 'message'=>'Company registerd successfully');
                    }else{
                        return array('status'=>400, 'message'=>'Company registration failed');
                    }
                }
                else{
                    return array('status'=>400, 'message'=>'Password do not match');
                }   
            }            
        }
        else{
            return array('status'=>400, 'message'=>'Please fill in the required fields. Company Name and Logo is a must.');
           }        
    }
    public function Login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email'=>'required',
            'password' => 'required',
        ]);
        if($validation->passes()){
            $checkexistence = Humanresource::all()->where('email',$request->input('email'))->first();
            if(!$checkexistence || !Hash::check($request->password, $checkexistence->password))
            {
                return array('status'=>400, 'message'=>'Wrong user credentials!!');
            }else{
                $request->session()->put('staff', $checkexistence);
                $company = DB::table('companies')->where('id', session('staff')->company_id)->first();
                $request->session()->put('company', $company);
                return array('status'=> 200, 'message'=> 'Login successfully. Redirecting ... ');
            }
        }
        else{
            return array('status'=>400, 'message'=>'Please fill in the signing form and retry');
           }
    }
}
