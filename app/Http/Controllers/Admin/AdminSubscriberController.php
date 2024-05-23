<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class AdminSubscriberController extends Controller
{
    public function show()
    {
        $subscriber_details = Subscribe::get();
        return view('admin.subscriber.view',compact('subscriber_details'));
    }
}
