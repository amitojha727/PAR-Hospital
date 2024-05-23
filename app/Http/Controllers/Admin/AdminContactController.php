<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function show()
    {
        $contact_details = Contact::get();
        return view('admin.contact.view',compact('contact_details'));
    }
}
