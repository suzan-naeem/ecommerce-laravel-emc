<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Validator;
class AuthController extends Controller
{
    public function login(Request $request)
    {
       
            $credentials = $request->only('email','password');
            
            if(auth('admin')->attempt($credentials)){
                //return view('dashboard.home.index');
                return redirect()->route('dashboard.index');

            } else {
                return redirect()->back()->with('danger', 'email or password is incorrect');
                // return view('dashboard.auth.login');
            }



    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('dashboard.login');
    }
    public function create()
    {
        return view('dashboard.auth.signup');
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[
            'password' => "required|min:6|confirmed",  
            'email' => 'required|email|unique:admins', 
            'name' => 'required',

        ]);
        Admin::create([
			'email' => $request->email,
            'name' => $request->name,
			'password' => bcrypt($request->password),    // password hash 
		]);
        return redirect()->route('dashboard.login');
    }


   

}