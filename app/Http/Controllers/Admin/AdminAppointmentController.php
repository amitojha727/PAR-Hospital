<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminAppointmentController extends Controller
{
    public function show()
    {
        $appointment_details = Appointment::get();
        return view('admin.appointment.view',compact('appointment_details'));
    }
}
