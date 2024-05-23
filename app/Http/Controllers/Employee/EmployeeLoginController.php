<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\Employee;

class EmployeeLoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('employee')->check())
        {
            return redirect()->route('employee.dashboard');
        }
        else
        {
            return view('employee.login');
        }    
    }
    public function employeelogin(Request $r)
    {
        // dd('hiii');
    	if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
        }
        //$r->session()->flush();
        $r->validate([
        'emp_user_id' => 'required|max:255',
        'password' => 'required|max:255',
        ]);
    
        $token = $r->input('g-recaptcha-response');

       if($token)
       { 
        // if($tot_num==($no1+$no2))
        // {
            if (Auth::guard('employee')->attempt(['emp_user_id' => $r->emp_user_id, 'password' => $r->password]))
    	    {
                return redirect()->route('employee.clients');
		    }
    	    return back()->withInput()->with('errmsg', 'Either Email/User id and password does not match or you do not have permission to access this login');
       }
       else
       {
            return back()->withInput()->with('errmsg', 'Please correct your answer');
       }    
    	//return $r->all();
    }
}
