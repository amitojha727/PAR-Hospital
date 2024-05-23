<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Employee;
use App\Models\Subscribe;
class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function about()
    {
        return view('about');
    }
    public function service()
    {
        return view('service');
    }
    public function department()
    {
        $department_list = Site::where('site_stat','A')->get();
        return view('department',compact('department_list'));
    }
    public function departmentDetails($dept)
    {
        $department = Site::where('site_id',$dept)->first();
        return view('departmentDetails',compact('dept','department'));
    }
    public function doctor()
    {
        $department_list = Site::where('site_stat','A')->get();
        $doctor_list = Employee::where('emp_stat','A')->get();
        return view('doctor',compact('department_list','doctor_list'));
    }
    public function doctorDetails($doctor_id)
    {
        $doctor = Employee::where('emp_id',$doctor_id)->first();
        $qualification = Qualification::where('emp_id',$doctor_id)->get();
        return view('doctorDetails',compact('doctor_id','doctor','qualification'));
    }
    public function contact()
    {
        return view('contact');
    }
    public function appoinment()
    {
        return view('appoinment');
    }
    public function subcribe(Request $request){
        //add contact into table
        $subcribe = new Subscribe;
        $subcribe->subscriber_mail = $request->subscriber_mail;
        $subcribe->save();
        
        $msg = [
            'title' =>'success',
            'text' => 'Your message has sent successfully.!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
}
