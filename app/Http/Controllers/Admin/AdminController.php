<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\Admin;
use App\Models\Site;
use App\Models\Employee;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\Contact;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function dashboard()
    {
        $deparments = Site::where('site_stat', 'A')->count();
        $doctors = Employee::where('emp_stat', 'A')->count();
        $patients = Client::where('client_stat','A')->count();
        $appointments = Appointment::count();
        $contacts = Contact::count();
        // dd($deparments);
        return view('admin.dashboard', compact('deparments','doctors','patients','appointments','contacts'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function changePassword()
    {
        return view('admin.changePassword');
    }
    public function changePasswordStore(Request $r)
    {
        
        $r->validate([
           'password' => 'required|confirmed|max:255'
        ]);

        $admin_id = Auth::guard('admin')->user()->admin_id;
        
        Admin::where('admin_id', $admin_id)
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
