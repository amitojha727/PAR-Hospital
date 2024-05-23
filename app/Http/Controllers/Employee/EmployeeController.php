<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function dashboard()
    {
        return redirect()->route('employee.clients');
        // return view('employee.dashboard');
    }
    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }
    public function changePassword()
    {
        return view('employee.changePassword');
    }
    public function changePasswordStore(Request $r)
    {
        
        $r->validate([
           'password' => 'required|confirmed|max:255'
        ]);

        $employee_id = Auth::guard('employee')->user()->emp_id;
        
        employee::where('emp_id', $employee_id)
            ->update([
            'password' => Hash::make($r->password)
            ]);
        $msg = [
            'title' => 'success',
            'text' => 'Password Change successfully!',
            'icon' => 'success'
        ];
        
        return back()->with('status', $msg);
            
    }
}
