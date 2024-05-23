<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Site;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $site_details = Site::where('site_stat','A')->get();
        return view('admin.site.index',compact('site_details'));
    }
    public function create()
    {
        $site_id = request('site_id');
        $site_details = [];
        if ($site_id != '') {
            $site_details = Site::where('site_id',$site_id)->first();
        }
        return view('admin.site.create',compact('site_id','site_details'));
    }
    public function store(Request $request)
    {
        // dd($request->site_title);
        $request->validate([
            'site_nm' => 'required|unique:site_mast',
            'site_short_desc' => 'required',
            'site_desc' => 'required'
        ],
        [
            'site_nm.required' => 'Name is required',
            'site_nm.unique' => 'This name is already present',
            'site_short_desc.required' => 'Short Description is required',
            'site_desc.required' => 'Description  is required',
        ]);
        // if ($cnt == 0) {
        //site id creation start
        $max_class = Site::select(DB::raw('MAX(CAST(SUBSTRING(site_id,2,length(site_id)-1) AS UNSIGNED)) as max_value'))->first();
        if($max_class->max_value=="")
        {
            $site_id = "S1";
        }
        else
        {
            $lastp = $max_class->max_value;
            $lastpp = ++$lastp;
            $site_id = 'S'.$lastpp;
        }
        $today = Carbon::now()->format('Y-m-d h:i:s');
        //add site into table
        $site = new Site;
        $site->site_id = $site_id;
        $site->site_nm = $request->site_nm;
        $site->site_short_desc = $request->site_short_desc;
        $site->site_desc = $request->site_desc;
        $site->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'New department created successfully!',
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
    public function update(Request $request,$site_id)
    {
        $today = Carbon::now()->format('Y-m-d h:i:s');
        // site::
        $site = Site::where('site_id',$site_id)->first();
        $site->site_nm = $request->site_nm;
        $site->site_short_desc = $request->site_short_desc;
        $site->site_desc = $request->site_desc;
        $site->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'Department updated successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function delete()
    {
        $site_id = request('site_id');
        Site::where('site_id',$site_id)->delete();
        $msg = [
            'title' => 'success',
            'text' => 'Department deleted successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
}
