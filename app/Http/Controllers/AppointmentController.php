<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Appointment;
use DB;
use Carbon\Carbon;
class AppointmentController extends Controller
{
    public function doctorList(Request $r)
    {
        // dd('hi');
        $site_id = $r->site_id;
        // dd($task_id);
        $doctor_list = Employee::where(['site_id' => $site_id])->select('emp_id','emp_fname','emp_sname')->orderBy('emp_fname','asc')->get();
        $output = '<option value="">Select Doctor</option>';
        if(count($doctor_list) > 0){
            foreach ($doctor_list as $key => $row) {
                $output .= '<option value="'.$row->emp_id.'">'.$row->emp_fname.' '.$row->emp_sname.'</option>';
            }
        }
        $data = [
            'output' => $output
        ];
        return $data;
    }
    public function appointmentAdd(Request $request)
    {
        $request->validate([
            'site_id' => 'required',
            'emp_id' => 'required',
            'appoinment_date' => 'required',
            'appoinment_time' => 'required',
            'applicant_name' => 'required',
            'applicant_contact_number' => 'required'
        ],
        [
            'site_id' => 'Please Select Department',
            'emp_id' => 'Please Select Doctor',
            'appoinment_date' => 'Please Enter Appointment Date',
            'appoinment_time' => 'Please Enter Appointment Time',
            'applicant_name' => 'Please Enter Applicant Name',
            'applicant_contact_number' => 'Please Enter Applicant Contact Number'
        ]);
        // if ($cnt == 0) {
        //appoinment id creation start
        $max_class = Appointment::select(DB::raw('MAX(CAST(SUBSTRING(appoinment_id,2,length(appoinment_id)-1) AS UNSIGNED)) as max_value'))->first();
        if($max_class->max_value=="")
        {
            $appoinment_id = "A1";
        }
        else
        {
            $lastp = $max_class->max_value;
            $lastpp = ++$lastp;
            $appoinment_id = 'A'.$lastpp;
        }
        $today = Carbon::now()->format('Y-m-d h:i:s');
        //add appointment into table
        $appointment = new Appointment;
        $appointment->appoinment_id = $appoinment_id;
        $appointment->site_id = $request->site_id;
        $appointment->emp_id = $request->emp_id;
        $appointment->appoinment_date = $request->appoinment_date;
        $appointment->appoinment_time = $request->appoinment_time;
        $appointment->applicant_name = $request->applicant_name;
        $appointment->applicant_contact_number = $request->applicant_contact_number;
        $appointment->message = $request->message;
        $appointment->save();
        
        $msg = [
            'title' =>'success',
            'text' => 'Appointment created successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
}
