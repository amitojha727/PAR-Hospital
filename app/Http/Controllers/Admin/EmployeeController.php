<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use App\Models\Site;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $employee_details = Employee::where('emp_stat','A')->get();
        return view('admin.employee.index',compact('employee_details'));
    }
    public function create()
    {
        $employee_id = request('employee_id');
        $employee_details = [];
        if ($employee_id != '') {
            $employee_details = Employee::where('emp_id',$employee_id)->first();
        }
        $site_details = Site::where('site_stat','A')->get();
        return view('admin.employee.create',compact('employee_id','employee_details','site_details'));
    }
    public function store(Request $request)
    {
        // dd($request->employee_title);
        $request->validate([
            'site_id' => 'required',
            'emp_fname' => 'required',
            'emp_sname' => 'required',
            'employe_intro' => 'required',
            'emp_user_id' => 'required|unique:employee_mast',
            'password' => 'required',
            'employe_img' => 'required|mimes:jpg,png,jpeg|max:1024'
        ],
        [
            'site_id.required' => 'Select Department',
            'emp_fname.required' => 'First Name is required',
            'emp_sname.required' => 'Last Name is required',
            'employe_intro.required' => 'Introduction is required',
            'emp_user_id.required' => 'User id is required',
            'emp_user_id.unique' => 'This user id is already present',
            'password.required' => 'Password is required',
            'employe_img.required' => 'This field is required'
        ]);
        // if ($cnt == 0) {
        //employee id creation start
        $max_class = Employee::select(DB::raw('MAX(CAST(SUBSTRING(emp_id,2,length(emp_id)-1) AS UNSIGNED)) as max_value'))->first();
        if($max_class->max_value=="")
        {
            $employee_id = "E1";
        }
        else
        {
            $lastp = $max_class->max_value;
            $lastpp = ++$lastp;
            $employee_id = 'E'.$lastpp;
        }
        $today = Carbon::now()->format('Y-m-d h:i:s');
        $employe_img = $this->base64data($request->employe_img);
        //add employee into table
        $employee = new Employee;
        $employee->emp_id = $employee_id;
        $employee->site_id = $request->site_id;
        $employee->emp_fname = $request->emp_fname;
        $employee->emp_sname = $request->emp_sname;
        $employee->employe_intro = $request->employe_intro;
        $employee->employe_skills = $request->employe_skills;
        $employee->emp_user_id = $request->emp_user_id;
        $employee->password = Hash::make($request->password);
        $employee->employe_img = $employe_img;
        $employee->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'New doctor created successfully!',
            'icon' => 'success'
        ];
        // }
        // else {
        //     $msg = [
        //         'title' => 'error',
        //         'text' => 'already exists!',
        //         'icon' => 'error'
        //     ];
        // }
        return back()->with('status', $msg);
    }
    public function update(Request $request,$employee_id)
    {
        $today = Carbon::now()->format('Y-m-d h:i:s');
        // employee
        $employe_img = $this->base64data($request->employe_img);
        $employee = Employee::where('emp_id',$employee_id)->first();
        $employee->site_id = $request->site_id;
        $employee->emp_fname = $request->emp_fname;
        $employee->emp_sname = $request->emp_sname;
        $employee->employe_intro = $request->employe_intro;
        $employee->employe_skills = $request->employe_skills;
        $employee->emp_user_id = $request->emp_user_id;
        $employee->employe_img = $employe_img;
        $employee->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'Doctor updated successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function delete()
    {
        $employee_id = request('employee_id');
        Employee::where('emp_id',$employee_id)->delete();
        $msg = [
            'title' => 'success',
            'text' => 'Doctor deleted successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function changePassword()
    {
        $employee_id = request('employee_id');
        $employee_details = Employee::where('emp_id',$employee_id)->first();
        return view('admin.employee.changePassword',compact('employee_details'));
    }
    public function changePasswordStore(Request $r)
    {
        
        $r->validate([
           'password' => 'required|confirmed|max:255'
        ]);

        $employee_id = $r->emp_id;
        
        employee::where('emp_id', $employee_id)
            ->update([
            'password' => Hash::make($r->password)
            ]);
        $msg = [
            'title' => 'success',
            'text' => 'Password Change successfully!',
            'icon' => 'success'
        ];
        
        return redirect()->route('admin.employees')->with('status', $msg);
            
    }
    private function base64data($data)
	{
		if($data == ''){
			return '';
		}
		$file = $data;
		$imageFileType = $file->getClientMimeType(); 
		$contents = base64_encode(file_get_contents($file->getRealPath()));
		//$file_data = 'data:image/'.$imageFileType.';base64,'.$contents;
		$file_data = 'data:'.$imageFileType.';base64,'.$contents;
		return $file_data;
		//return $contents;
	}
    //qualification
    public function Qualification()
    {
        $employee_id = request('employee_id');
        $qualification_details = Qualification::where('emp_id',$employee_id)->get();
        return view('admin.employee.qualification.show',compact('qualification_details','employee_id'));
    }
    public function addQualification()
    {
        $employee_id = request('employee_id');
        $id = request('id');
        $qualification_details = [];
        if ($employee_id != '') {
            $qualification_details = Qualification::where('id',$id)->where('emp_id',$employee_id)->first();
        }
        return view('admin.employee.qualification.create',compact('employee_id','qualification_details','id'));
    }
    public function addQualificationPost(Request $request)
    {
        // dd($request->employee_title);
        $request->validate([
            'degree_name' => 'required',
            'degree_start_year' => 'required',
            'degree_end_year' => 'required',
            'degree_intro' => 'required'
        ],
        [
            'degree_name.required' => 'Degree name is required',
            'degree_start_year.required' => 'Degree start year is required',
            'degree_end_year.required' => 'Degree end year is required',
            'degree_intro.required' => 'Introduction is required'
        ]);

        //add employee into table
        $qualification = new Qualification;
        $qualification->emp_id = $request->emp_id;
        $qualification->degree_name = $request->degree_name;
        $qualification->degree_start_year = $request->degree_start_year;
        $qualification->degree_end_year = $request->degree_end_year;
        $qualification->degree_intro = $request->degree_intro;
        $qualification->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'Qualification added successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function updateQualification(Request $request,$id)
    {
        $today = Carbon::now()->format('Y-m-d h:i:s');
        // qualification
        $qualification = Qualification::where('id',$id)->first();
        $qualification->degree_name = $request->degree_name;
        $qualification->degree_start_year = $request->degree_start_year;
        $qualification->degree_end_year = $request->degree_end_year;
        $qualification->degree_intro = $request->degree_intro;
        $qualification->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'Qualification updated successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function deleteQualification()
    {
        $id = request('id');
        Qualification::where('id',$id)->delete();
        $msg = [
            'title' => 'success',
            'text' => 'Qualification deleted successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
}
