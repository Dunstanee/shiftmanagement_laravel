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
                        return array('status'=> 200, 'message'=>'Company registered successfully');
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
    public function Staff(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name' => 'required',
            'email' => 'required',
            'contact' => 'required',
        ]);
        if($validation->passes())
        {
           $no = Humanresource::all()->where('email',$request->email )->count();
           if ($no > 0) {
                return array('status'=> 400, 'message'=>'Email already exists');
           } else {
              
            $query = DB::table('humanresources')->insertGetId([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'company_id'=>session('company')->id,
            'role'=>1,
            'password'=>Hash::make('staff123'),
            ]);
            if($query) 
            {
                return array('status'=> 200, 'message'=>'New Staff registered successfully');
            }else{
                return array('status'=>400, 'message'=>'New Staff registration failed');
            }
            
           }
        }
        else
        {
            return array('status'=>400, 'message'=>'Please fill in the required fields. ');
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
    public function NewEmployee(Request $request)
    {
        if(self::Checkloggins($request) == 1)
       {
            $validation = Validator::make($request->all(),[
                'first_name'=>'required',
                'last_name' => 'required',
                'national_id' => 'required',
                'city' => 'required',
                'contact' => 'required',
                'dob' => 'required',
                'gender' => 'required',
            ]);
            if($validation->passes()){
               $count =  DB::table('employees')->where('national_id', $request->national_id)->count();
               if ($count > 0) {
                    return array('status'=>400, 'message'=>'Duplicate entry National ID/ Passport');
               } else {
                   $query = DB::table('employees')->insert([
                    'first_name'=>$request->first_name,
                    'last_name' => $request->last_name,
                    'national_id' => $request->national_id,
                    'city' => $request->city,
                    'contact' => $request->contact,
                    'dob' => $request->dob,  
                    'email' => $request->email,  
                    'gender' => $request->gender,  
                    'company_id' => session('company')->id,  
                    'password' => Hash::make($request->national_id),  
                    ]);
                    if($query)
                    {
                        return array('status'=>200, 'message'=>'New employee registration is successful');
                    }
                    else{
                        return array('status'=>400, 'message'=>'New employee registration failed');
                    }
                }
            }
            else{
                return array('status'=>400, 'message'=>'Please fill in the employee form complete form and retry');
               }
       }
       return view('/');
    }
    public function UpdateEmployee(Request $request, $id)
    {
        if(self::Checkloggins($request) == 1)
       {
            $validation = Validator::make($request->all(),[
                'first_name'=>'required',
                'last_name' => 'required',
                'national_id' => 'required',
                'city' => 'required',
                'contact' => 'required',
                'dob' => 'required',
                'gender' => 'required',
            ]);
            if($validation->passes()){
               $count =  DB::table('employees')
                                    ->where('national_id', $request->national_id)
                                    ->whereNotIn('id',[$id])
                                    ->count();
               if ($count > 0) {
                    return array('status'=>400, 'message'=>'Duplicate entry National ID/ Passport');
               } else {
                   $query = DB::table('employees')
                                    ->where('id',$id)
                                    ->update($request->all());
                    if($query)
                    {
                        return array('status'=>200, 'message'=>'Employee Updated successfully');
                    }
                    else{
                        return array('status'=>400, 'message'=>'Employee Update failed');
                    }
                }
            }
            else{
                return array('status'=>400, 'message'=>'Check you data well and try again');
               }
       }
       return view('/');
    }
    public function SendSms(Request $request)
    {
        if(self::Checkloggins($request) == 1)
       {
            $validation = Validator::make($request->all(),[
                'message'=>'required',
                'employee_id' => 'required',
            ]);
            if($validation->passes())
            {
                $sent_to =  "";
                for ($i=0; $i <= count($request->employee_id)-1; $i++) { 
                    $sent_to .= $request->employee_id[$i]  ;
                }
                $queryid = DB::table('messages')->insert([
                    'staff_id'=>session('staff')->id,
                    'sent_to'=>json_encode($request->employee_id),
                    'message'=>$request->message,
                ]);
                if ($queryid) {
                        return array('status'=>200, 'message'=>'Message sent successfully');
                      
                } else {
                    return array('status'=>400, 'message'=>'Message sent failed');
                }
                
                return $queryid;
            }
            else{
                return array('status'=>400, 'message'=>'Check you data well and try again');
               }
        
       }
       return view('/');
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
