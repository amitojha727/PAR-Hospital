<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function contactAdd(Request $request)
    {
        // dd('hi');
        $request->validate([
            'name' => 'required',
            'email_address' => 'required',
            'contact_number' => 'required',
            'query_topic' => 'required',
            'message' => 'required',
        ],
        [
            'name' => 'Please Enter Name.',
            'email_address' => 'Please Enter Email address.',
            'contact_number' => 'Please Enter Contact Number',
            'query_topic' => 'Please Enter Your Query Topic',
            'message' => 'Please Enter a message',
        ]);
        $today = Carbon::now()->format('Y-m-d h:i:s');
        //add contact into table
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email_address = $request->email_address;
        $contact->contact_number = $request->contact_number;
        $contact->query_topic = $request->query_topic;
        $contact->message = $request->message;
        $contact->save();
        
        $msg = [
            'title' =>'success',
            'text' => 'Your message has sent successfully.!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
}
