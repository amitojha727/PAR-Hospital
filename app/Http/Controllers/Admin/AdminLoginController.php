<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return view('admin.login');
        }    
    }
    public function adminlogin(Request $r)
    {
        // dd('hiii');
    	if(Auth::guard('employee')->check())
        {
            Auth::guard('employee')->logout();
        }
        //$r->session()->flush();
        $r->validate([
        'admin_user_id' => 'required|max:255',
        'admin_password' => 'required|max:255',
        ]);
    
        $token = $r->input('g-recaptcha-response');

       if($token)
       { 
        // if($tot_num==($no1+$no2))
        // {
            if (Auth::guard('admin')->attempt(['admin_user_id' => $r->admin_user_id, 'password' => $r->admin_password, 'admin_status' => 'T'])) 
    	    {
                return redirect()->route('admin.dashboard');
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
