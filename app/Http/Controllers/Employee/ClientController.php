<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use PDF;
use Excel;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Client;
use App\Models\ClientForm;
use App\Models\ClientBehavior;
use App\Models\ClientDailyRoutine;
use App\Models\ClientGeneralObservation;
use App\Models\ClientHealthStatus;
use App\Models\ClientSocialWellBeing;
use App\Models\ClientInapporiateBehavior;
use App\Imports\ReportImport;
use App\Models\ReportExcel;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index()
    {
        $site_id = Auth::guard('employee')->user()->site_id;
        $client_details = Client::where('client_stat','A')->where('site_id',$site_id)->get();
        return view('employee.client.index',compact('client_details'));
    }
    public function create()
    {
        $client_id = request('client_id');
        $client_details = [];
        if ($client_id != '') {
            $client_details = Client::where('client_id',$client_id)->first();
        }
        return view('employee.client.create',compact('client_id','client_details'));
    }
    public function store(Request $request)
    {
        // dd($request->client_title);
        $request->validate([
            'client_fname' => 'required',
            'client_sname' => 'required',
            'client_contact_no' => 'required',
            'client_disease' => 'required',
            'client_admission_date' => 'required'
        ],
        [
            'client_fname.required' => 'First Name is required',
            'client_sname.required' => 'Last Name is required',
            'client_contact_no.required' => 'Contact Number is required',
            'client_disease.required' => 'Disease is required',
            'client_admission_date.required' => 'Date of Admission is required'
        ]);
        // if ($cnt == 0) {
        //client id creation start
        $max_class = Client::select(DB::raw('MAX(CAST(SUBSTRING(client_id,2,length(client_id)-1) AS UNSIGNED)) as max_value'))->first();
        if($max_class->max_value=="")
        {
            $client_id = "C1";
        }
        else
        {
            $lastp = $max_class->max_value;
            $lastpp = ++$lastp;
            $client_id = 'C'.$lastpp;
        }
        $today = Carbon::now()->format('Y-m-d h:i:s');
        $emp_id = Auth::guard('employee')->user()->emp_id;
        $site_id = Auth::guard('employee')->user()->site_id;
        //add client into table
        $client = new Client;
        $client->client_id = $client_id;
        $client->emp_id = $emp_id;
        $client->site_id = $site_id;
        $client->client_fname = $request->client_fname;
        $client->client_sname = $request->client_sname;
        $client->client_contact_no = $request->client_contact_no;
        $client->client_disease = $request->client_disease;
        $client->client_admission_date = $request->client_admission_date;
        $client->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'New client created successfully!',
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
    public function update(Request $request,$client_id)
    {
        $today = Carbon::now()->format('Y-m-d h:i:s');
        // client::
        $client = Client::where('client_id',$client_id)->first();
        $client->client_fname = $request->client_fname;
        $client->client_sname = $request->client_sname;
        $client->client_contact_no = $request->client_contact_no;
        $client->client_disease = $request->client_disease;
        $client->client_admission_date = $request->client_admission_date;
        $client->save();
        
        $msg = [
            'title' => 'success',
            'text' => 'client updated successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function delete()
    {
        $client_id = request('client_id');
        Client::where('client_id',$client_id)->delete();
        $msg = [
            'title' => 'success',
            'text' => 'client deleted successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function addDetails()
    {
        $client_id = request('client_id');
        $form_id = request('form_id');
        $client_details = Client::where('client_id',$client_id)->first();

        $form_details = [];
        $health_details = [];
        $routine_details = [];
        $social_details = [];
        $general_details = [];
        $behavior_details = [];
        $inapporiate_details = [];
        if ($form_id != '') {
            $form_details = ClientForm::where('form_id',$form_id)->get();
            $health_details = ClientHealthStatus::where('form_id',$form_id)->get();
            $routine_details = ClientDailyRoutine::where('form_id',$form_id)->get();
            $social_details = ClientSocialWellBeing::where('form_id',$form_id)->get();
            $general_details = ClientGeneralObservation::where('form_id',$form_id)->get();
            $behavior_details = ClientBehavior::where('form_id',$form_id)->get();
            $inapporiate_details = ClientInapporiateBehavior::where('form_id',$form_id)->get();
        }
        
        return view('employee.client.addDetails',compact('client_id','form_id','client_details','form_details','health_details','routine_details','social_details','general_details','behavior_details','inapporiate_details'));
    }
    public function storeDetails(Request $request)
    {
        $client_id = $request->client_id;
        
        $cnt = ClientForm::whereRaw("str_to_date(date,'%d-%m-%Y') = str_to_date('".$request->date."','%d-%m-%Y')")->where('client_id',$client_id)->count();
        // dd($cnt);
        if ($cnt == 0) {
            $medi_morning = explode("|",$request->medi_morning);
            $medi_afternoon = explode("|",$request->medi_afternoon);
            $medi_evening = explode("|",$request->medi_evening);
            $appo_stat = explode("|",$request->appo_stat);
            $teeth_morning = explode("|",$request->teeth_morning);
            $teeth_evening = explode("|",$request->teeth_evening);
            $shower_morning = explode("|",$request->shower_morning);
            $shower_evening = explode("|",$request->shower_evening);
            $bed_morning = explode("|",$request->bed_morning);
            $bed_evening = explode("|",$request->bed_evening);
            $clothes_morning = explode("|",$request->clothes_morning);
            $clothes_evening = explode("|",$request->clothes_evening);
            $floor_morning = explode("|",$request->floor_morning);
            $floor_evening = explode("|",$request->floor_evening);
            $bedtime_evening = explode("|",$request->bedtime_evening);
            $school_stat = explode("|",$request->school_stat);
            $community_stat = explode("|",$request->community_stat);
            $house_stat = explode("|",$request->house_stat);
            $activities_stat = explode("|",$request->activities_stat);
            $family_stat = explode("|",$request->family_stat);
            $caseworker_stat = explode("|",$request->caseworker_stat);
            $emotional_morning = explode("|",$request->emotional_morning);
            $emotional_evening = explode("|",$request->emotional_evening);
            $rule_stat = explode("|",$request->rule_stat);
            $instruction_stat = explode("|",$request->instruction_stat);
            $behavior_stat = explode("|",$request->behavior_stat);
            // dd($teeth_morning);
            //form id creation start
            $max_class = ClientForm::select(DB::raw('MAX(CAST(SUBSTRING(form_id,2,length(form_id)-1) AS UNSIGNED)) as max_value'))->first();
            if($max_class->max_value=="")
            {
                $form_id = "F1";
            }
            else
            {
                $lastp = $max_class->max_value;
                $lastpp = ++$lastp;
                $form_id = 'F'.$lastpp;
            }
            $today = Carbon::now()->format('Y-m-d h:i:s');
            //add form into table
            $form = new ClientForm;
            $form->form_id = $form_id;
            $form->client_id = $client_id;
            $form->date = $request->date;
            $form->save();

            $health = new ClientHealthStatus;
            $health->form_id = $form_id;
            $health->client_id = $client_id;
            $health->date = $request->date;
            $health->medi_morning = $medi_morning[0];
            $health->medi_morning_no = $medi_morning[1];
            $health->medi_afternoon = $medi_afternoon[0];
            $health->medi_afternoon_no = $medi_afternoon[1];
            $health->medi_evening = $medi_evening[0];
            $health->medi_evening_no = $medi_evening[1];
            $health->appo_stat = $appo_stat[0];
            $health->appo_stat_no = $appo_stat[1];
            $health->appo_other = $request->appo_other;
            $health->save();
            // health score
            $health_score = $medi_morning[1] + $medi_afternoon[1] + $medi_evening[1] + $appo_stat[1];
            $health_tot_score = 0;
            if ($medi_morning[1] != 0) {
                $health_tot_score = $health_tot_score + 2;
            }
            if ($medi_afternoon[1] != 0) {
                $health_tot_score = $health_tot_score + 2;
            }
            if ($medi_evening[1] != 0) {
                $health_tot_score = $health_tot_score + 2;
            }
            if ($appo_stat[1] != 0) {
                $health_tot_score = $health_tot_score + 2;
            }
            // dd('hiiiii');
            $routine = new ClientDailyRoutine;
            $routine->form_id = $form_id;
            $routine->client_id = $client_id;
            $routine->date = $request->date;
            $routine->teeth_morning = $teeth_morning[0];
            $routine->teeth_morning_no = $teeth_morning[1];
            $routine->teeth_evening = $teeth_evening[0];
            $routine->teeth_evening_no = $teeth_evening[1];
            $routine->shower_morning = $shower_morning[0];
            $routine->shower_morning_no = $shower_morning[1];
            $routine->shower_evening = $shower_evening[0];
            $routine->shower_evening_no = $shower_evening[1];
            $routine->bed_morning = $bed_morning[0];
            $routine->bed_morning_no = $bed_morning[1];
            $routine->bed_evening = $bed_evening[0];
            $routine->bed_evening_no = $bed_evening[1];
            $routine->clothes_morning = $clothes_morning[0];
            $routine->clothes_morning_no = $clothes_morning[1];
            $routine->clothes_evening = $clothes_evening[0];
            $routine->clothes_evening_no = $clothes_evening[1];
            $routine->floor_morning = $floor_morning[0];
            $routine->floor_morning_no = $floor_morning[1];
            $routine->floor_evening = $floor_evening[0];
            $routine->floor_evening_no = $floor_evening[1];
            $routine->bedtime_evening = $bedtime_evening[0];
            $routine->bedtime_evening_no = $bedtime_evening[1];
            $routine->save();
            // routine score
            $routine_score = $teeth_morning[1] + $teeth_evening[1] + 
                $shower_morning[1] + $shower_evening[1] + 
                $bed_morning[1] + $bed_evening[1] + 
                $clothes_morning[1] + $clothes_evening[1] + 
                $floor_morning[1] + $floor_evening[1] + 
                $bedtime_evening[1];
            $routine_tot_score = 0;
            if ($teeth_morning[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($teeth_evening[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($shower_morning[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($shower_evening[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($bed_morning[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($bed_evening[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($clothes_morning[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($clothes_evening[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($floor_morning[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($floor_evening[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }
            if ($bedtime_evening[1] != 0) {
                $routine_tot_score = $routine_tot_score + 2;
            }

            $social = new ClientSocialWellBeing;
            $social->form_id = $form_id;
            $social->client_id = $client_id;
            $social->date = $request->date;
            $social->school_stat = $school_stat[0];
            $social->school_stat_no = $school_stat[1];
            $social->community_stat = $community_stat[0];
            $social->community_stat_no = $community_stat[1];
            $social->house_stat = $house_stat[0];
            $social->house_stat_no = $house_stat[1];
            $social->activities_stat = $activities_stat[0];
            $social->activities_stat_no = $activities_stat[1];
            $social->family_stat = $family_stat[0];
            $social->family_stat_no = $family_stat[1];
            $social->family_other = $request->family_other;
            $social->caseworker_stat = $caseworker_stat[0];
            $social->caseworker_stat_no = $caseworker_stat[1];
            $social->caseworker_other = $request->caseworker_other;
            $social->save();
            // social score
            $social_score = $school_stat[1] + $community_stat[1] + $house_stat[1] + $activities_stat[1] + $family_stat[1] + $caseworker_stat[1];
            $social_tot_score = 0;
            if ($school_stat[1] != 0) {
                $social_tot_score = $social_tot_score + 2;
            }
            if ($community_stat[1] != 0) {
                $social_tot_score = $social_tot_score + 2;
            }
            if ($house_stat[1] != 0) {
                $social_tot_score = $social_tot_score + 2;
            }
            if ($activities_stat[1] != 0) {
                $social_tot_score = $social_tot_score + 2;
            }
            if ($family_stat[1] != 0) {
                $social_tot_score = $social_tot_score + 2;
            }
            if ($caseworker_stat[1] != 0) {
                $social_tot_score = $social_tot_score + 2;
            }

            $general = new ClientGeneralObservation;
            $general->form_id = $form_id;
            $general->client_id = $client_id;
            $general->date = $request->date;
            $general->emotional_morning = $emotional_morning[0];
            $general->emotional_morning_no = $emotional_morning[1];
            $general->emotional_evening = $emotional_evening[0];
            $general->emotional_evening_no = $emotional_evening[1];
            $general->save();
            // general score
            $general_score = $emotional_morning[1] + $emotional_evening[1];
            $general_tot_score = 0;
            if ($emotional_morning[1] != 0) {
                $general_tot_score = $general_tot_score + 2;
            }
            if ($emotional_evening[1] != 0) {
                $general_tot_score = $general_tot_score + 2;
            }
            
            $behavior = new ClientBehavior;
            $behavior->form_id = $form_id;
            $behavior->client_id = $client_id;
            $behavior->date = $request->date;
            $behavior->rule_stat = $rule_stat[0];
            $behavior->rule_stat_no = $rule_stat[1];
            $behavior->instruction_stat = $instruction_stat[0];
            $behavior->instruction_stat_no = $instruction_stat[1];
            $behavior->behavior_stat = $behavior_stat[0];
            $behavior->behavior_stat_no = $behavior_stat[1];
            $behavior->save();
            // behavior score
            $behavior_score = $rule_stat[1] + $instruction_stat[1] + $behavior_stat[1];
            $behavior_tot_score = 0;
            if ($rule_stat[1] != 0) {
                $behavior_tot_score = $behavior_tot_score + 3;
            }
            if ($instruction_stat[1] != 0) {
                $behavior_tot_score = $behavior_tot_score + 3;
            }
            if ($behavior_stat[1] != 0) {
                $behavior_tot_score = $behavior_tot_score + 3;
            }

            $behavior_other = $request->behavior_other;
            $inapporiate_score = 0;
            if (isset($behavior_other) && count($behavior_other) > 0) {
                foreach ($behavior_other as $key => $row) {
                    if ($row != '') {
                        $inapporiate = new ClientInapporiateBehavior;
                        $inapporiate->form_id = $form_id;
                        $inapporiate->client_id = $client_id;
                        $inapporiate->date = $request->date;
                        $inapporiate->behavior_other = $row;
                        $inapporiate->behavior_other_no = $request->behavior_other_no[$key];
                        $inapporiate->save();
                        // inapporiate score
                        $inapporiate_score += $request->behavior_other_no[$key];
                    }
                }
            }

            $tot_score = $health_score + $routine_score + $social_score + $general_score + $behavior_score + $inapporiate_score;
            $total_overalle_score = $health_tot_score + $routine_tot_score + $social_tot_score + $general_tot_score + $behavior_tot_score;
            // update total score
            $form = ClientForm::findOrFail($form_id);
            $form->score = $tot_score;
            $form->total_overalle_score = $total_overalle_score;
            $form->health_score = $health_score;
            $form->health_tot_score = $health_tot_score;
            $form->routine_score = $routine_score;
            $form->routine_tot_score = $routine_tot_score;
            $form->social_score = $social_score;
            $form->social_tot_score = $social_tot_score;
            $form->general_score = $general_score;
            $form->general_tot_score = $general_tot_score;
            $form->behavior_score = $behavior_score;
            $form->behavior_tot_score = $behavior_tot_score;
            $form->inapporiate_score = $inapporiate_score;
            $form->tot_behavior_score = ($behavior_score+$inapporiate_score);
            $form->save();

            $msg = [
                'title' => 'success',
                'text' => 'Form created successfully!',
                'icon' => 'success'
            ];
            // return back()->with('status', $msg);
            return redirect()->route('employee.clients')->with('status', $msg);
        }
        else {
            $msg = [
                'title' => 'error',
                'text' => 'Form already created on this date!',
                'icon' => 'error'
            ];
            return back()->with('status', $msg);
            // dd($cnt,$request->date);
        }
    }
    public function viewDetails()
    {
        $client_id = request('client_id');
        $client_details = Client::where('client_id',$client_id)->first();
        $form_details = ClientForm::where('client_id',$client_id)
            ->orderByRaw("str_to_date(date,'%d/%m/%Y') desc")
            ->get();
        // dd($form_details);
        return view('employee.client.viewDetails',compact('client_id','client_details','form_details'));
    }
    public function updateDetails(Request $request,$form_id)
    {
        $client_id = $request->client_id;

        $medi_morning = explode("|",$request->medi_morning);
        $medi_afternoon = explode("|",$request->medi_afternoon);
        $medi_evening = explode("|",$request->medi_evening);
        $appo_stat = explode("|",$request->appo_stat);
        $teeth_morning = explode("|",$request->teeth_morning);
        $teeth_evening = explode("|",$request->teeth_evening);
        $shower_morning = explode("|",$request->shower_morning);
        $shower_evening = explode("|",$request->shower_evening);
        $bed_morning = explode("|",$request->bed_morning);
        $bed_evening = explode("|",$request->bed_evening);
        $clothes_morning = explode("|",$request->clothes_morning);
        $clothes_evening = explode("|",$request->clothes_evening);
        $floor_morning = explode("|",$request->floor_morning);
        $floor_evening = explode("|",$request->floor_evening);
        $bedtime_evening = explode("|",$request->bedtime_evening);
        $school_stat = explode("|",$request->school_stat);
        $community_stat = explode("|",$request->community_stat);
        $house_stat = explode("|",$request->house_stat);
        $activities_stat = explode("|",$request->activities_stat);
        $family_stat = explode("|",$request->family_stat);
        $caseworker_stat = explode("|",$request->caseworker_stat);
        $emotional_morning = explode("|",$request->emotional_morning);
        $emotional_evening = explode("|",$request->emotional_evening);
        $rule_stat = explode("|",$request->rule_stat);
        $instruction_stat = explode("|",$request->instruction_stat);
        $behavior_stat = explode("|",$request->behavior_stat);
        // dd($teeth_morning);

        $health = ClientHealthStatus::where('form_id',$form_id)->first();
        $health->date = $request->date;
        $health->medi_morning = $medi_morning[0];
        $health->medi_morning_no = $medi_morning[1];
        $health->medi_afternoon = $medi_afternoon[0];
        $health->medi_afternoon_no = $medi_afternoon[1];
        $health->medi_evening = $medi_evening[0];
        $health->medi_evening_no = $medi_evening[1];
        $health->appo_stat = $appo_stat[0];
        $health->appo_stat_no = $appo_stat[1];
        $health->appo_other = $request->appo_other;
        $health->save();
        // health score
        $health_score = $medi_morning[1] + $medi_afternoon[1] + $medi_evening[1] + $appo_stat[1];
        $health_tot_score = 0;
        if ($medi_morning[1] != 0) {
            $health_tot_score = $health_tot_score + 2;
        }
        if ($medi_afternoon[1] != 0) {
            $health_tot_score = $health_tot_score + 2;
        }
        if ($medi_evening[1] != 0) {
            $health_tot_score = $health_tot_score + 2;
        }
        if ($appo_stat[1] != 0) {
            $health_tot_score = $health_tot_score + 2;
        }
        // dd('hiiiii');
        $routine = ClientDailyRoutine::where('form_id',$form_id)->first();
        $routine->date = $request->date;
        $routine->teeth_morning = $teeth_morning[0];
        $routine->teeth_morning_no = $teeth_morning[1];
        $routine->teeth_evening = $teeth_evening[0];
        $routine->teeth_evening_no = $teeth_evening[1];
        $routine->shower_morning = $shower_morning[0];
        $routine->shower_morning_no = $shower_morning[1];
        $routine->shower_evening = $shower_evening[0];
        $routine->shower_evening_no = $shower_evening[1];
        $routine->bed_morning = $bed_morning[0];
        $routine->bed_morning_no = $bed_morning[1];
        $routine->bed_evening = $bed_evening[0];
        $routine->bed_evening_no = $bed_evening[1];
        $routine->clothes_morning = $clothes_morning[0];
        $routine->clothes_morning_no = $clothes_morning[1];
        $routine->clothes_evening = $clothes_evening[0];
        $routine->clothes_evening_no = $clothes_evening[1];
        $routine->floor_morning = $floor_morning[0];
        $routine->floor_morning_no = $floor_morning[1];
        $routine->floor_evening = $floor_evening[0];
        $routine->floor_evening_no = $floor_evening[1];
        $routine->bedtime_evening = $bedtime_evening[0];
        $routine->bedtime_evening_no = $bedtime_evening[1];
        $routine->save();
        // routine score
        $routine_score = $teeth_morning[1] + $teeth_evening[1] + 
            $shower_morning[1] + $shower_evening[1] + 
            $bed_morning[1] + $bed_evening[1] + 
            $clothes_morning[1] + $clothes_evening[1] + 
            $floor_morning[1] + $floor_evening[1] + 
            $bedtime_evening[1];
        $routine_tot_score = 0;
        if ($teeth_morning[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($teeth_evening[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($shower_morning[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($shower_evening[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($bed_morning[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($bed_evening[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($clothes_morning[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($clothes_evening[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($floor_morning[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($floor_evening[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        if ($bedtime_evening[1] != 0) {
            $routine_tot_score = $routine_tot_score + 2;
        }
        $social = ClientSocialWellBeing::where('form_id',$form_id)->first();
        $social->date = $request->date;
        $social->school_stat = $school_stat[0];
        $social->school_stat_no = $school_stat[1];
        $social->community_stat = $community_stat[0];
        $social->community_stat_no = $community_stat[1];
        $social->house_stat = $house_stat[0];
        $social->house_stat_no = $house_stat[1];
        $social->activities_stat = $activities_stat[0];
        $social->activities_stat_no = $activities_stat[1];
        $social->family_stat = $family_stat[0];
        $social->family_stat_no = $family_stat[1];
        $social->family_other = $request->family_other;
        $social->caseworker_stat = $caseworker_stat[0];
        $social->caseworker_stat_no = $caseworker_stat[1];
        $social->caseworker_other = $request->caseworker_other;
        $social->save();
        // social score
        $social_score = $school_stat[1] + $community_stat[1] + $house_stat[1] + $activities_stat[1] + $family_stat[1] + $caseworker_stat[1];
        $social_tot_score = 0;
        if ($school_stat[1] != 0) {
            $social_tot_score = $social_tot_score + 2;
        }
        if ($community_stat[1] != 0) {
            $social_tot_score = $social_tot_score + 2;
        }
        if ($house_stat[1] != 0) {
            $social_tot_score = $social_tot_score + 2;
        }
        if ($activities_stat[1] != 0) {
            $social_tot_score = $social_tot_score + 2;
        }
        if ($family_stat[1] != 0) {
            $social_tot_score = $social_tot_score + 2;
        }
        if ($caseworker_stat[1] != 0) {
            $social_tot_score = $social_tot_score + 2;
        }

        $general = ClientGeneralObservation::where('form_id',$form_id)->first();
        $general->date = $request->date;
        $general->emotional_morning = $emotional_morning[0];
        $general->emotional_morning_no = $emotional_morning[1];
        $general->emotional_evening = $emotional_evening[0];
        $general->emotional_evening_no = $emotional_evening[1];
        $general->save();
        // general score
        $general_score = $emotional_morning[1] + $emotional_evening[1];
        $general_tot_score = 0;
        if ($emotional_morning[1] != 0) {
            $general_tot_score = $general_tot_score + 2;
        }
        if ($emotional_evening[1] != 0) {
            $general_tot_score = $general_tot_score + 2;
        }

        $behavior = ClientBehavior::where('form_id',$form_id)->first();
        $behavior->date = $request->date;
        $behavior->rule_stat = $rule_stat[0];
        $behavior->rule_stat_no = $rule_stat[1];
        $behavior->instruction_stat = $instruction_stat[0];
        $behavior->instruction_stat_no = $instruction_stat[1];
        $behavior->behavior_stat = $behavior_stat[0];
        $behavior->behavior_stat_no = $behavior_stat[1];
        $behavior->save();
        // behavior score
        $behavior_score = $rule_stat[1] + $instruction_stat[1] + $behavior_stat[1];
        $behavior_tot_score = 0;
        if ($rule_stat[1] != 0) {
            $behavior_tot_score = $behavior_tot_score + 3;
        }
        if ($instruction_stat[1] != 0) {
            $behavior_tot_score = $behavior_tot_score + 3;
        }
        if ($behavior_stat[1] != 0) {
            $behavior_tot_score = $behavior_tot_score + 3;
        }

        $behavior_other = $request->behavior_other;
        $inapporiate_score = 0;
        ClientInapporiateBehavior::where('form_id',$form_id)->delete();
        if (isset($behavior_other) && count($behavior_other) > 0) {
            foreach ($behavior_other as $key => $row) {
                if ($row != '') {
                    $inapporiate = new ClientInapporiateBehavior;
                    $inapporiate->form_id = $form_id;
                    $inapporiate->client_id = $client_id;
                    $inapporiate->date = $request->date;
                    $inapporiate->behavior_other = $row;
                    $inapporiate->behavior_other_no = $request->behavior_other_no[$key];
                    $inapporiate->save();
                    // inapporiate score
                    $inapporiate_score += $request->behavior_other_no[$key];
                }
            }
        }

        $tot_score = $health_score + $routine_score + $social_score + $general_score + $behavior_score + $inapporiate_score;
        $total_overalle_score = $health_tot_score + $routine_tot_score + $social_tot_score + $general_tot_score + $behavior_tot_score;
        // update total score
        $form = ClientForm::findOrFail($form_id);
        $form->date = $request->date;
        $form->score = $tot_score;
        $form->total_overalle_score = $total_overalle_score;
        $form->health_score = $health_score;
        $form->health_tot_score = $health_tot_score;
        $form->routine_score = $routine_score;
        $form->routine_tot_score = $routine_tot_score;
        $form->social_score = $social_score;
        $form->social_tot_score = $social_tot_score;
        $form->general_score = $general_score;
        $form->general_tot_score = $general_tot_score;
        $form->behavior_score = $behavior_score;
        $form->behavior_tot_score = $behavior_tot_score;
        $form->inapporiate_score = $inapporiate_score;
        $form->tot_behavior_score = ($behavior_score+$inapporiate_score);
        $form->save();

        $msg = [
            'title' => 'success',
            'text' => 'Form updated successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
        // return redirect()->route('employee.clients')->with('status', $msg);
    }
    public function deleteDetails()
    {
        $form_id = request('form_id');
        ClientHealthStatus::where('form_id',$form_id)->delete();
        ClientDailyRoutine::where('form_id',$form_id)->delete();
        ClientSocialWellBeing::where('form_id',$form_id)->delete();
        ClientGeneralObservation::where('form_id',$form_id)->delete();
        ClientBehavior::where('form_id',$form_id)->delete();
        ClientInapporiateBehavior::where('form_id',$form_id)->delete();
        ClientForm::where('form_id',$form_id)->delete();
        $msg = [
            'title' => 'success',
            'text' => 'Form deleted successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function reportDetails(Request $request)
    {
        $client_id = $request->client_id;
        $filter_by = $request->filter_by;
        if ($filter_by != '') {
            switch($filter_by) {
                case('Daily'):
                    $to_date = date('d-m-Y');
                    $from_date = date('d-m-Y');
                    break;
                case('Weekly'):
                    $to_date = date('d-m-Y');
                    $from_date = date('d-m-Y', strtotime('-7 days'));
                    break;
                case('Monthly'):
                    $to_date = date('d-m-Y');
                    $from_date = date("d-m-Y",strtotime("-1 month"));
                    break;
                case('Quarterly'):
                    $to_date = date('d-m-Y');
                    $from_date = date("d-m-Y",strtotime("-6 month"));
                    break;
                case('Yearly'):
                    $to_date = date('d-m-Y');
                    $from_date = date("d-m-Y",strtotime("-1 year"));
                    break;
                default:
                    $to_date = date('d-m-Y');
                    $from_date = date('d-m-Y');
            }
        }
        else {
            $to_date = $request->to_date;
            $from_date = $request->from_date;
        }
        
        $client_details = Client::where('client_id',$client_id)->first();

        $cur_date = date("Y-m-d");
        $last_date = date("Y-m-d",strtotime("-1 month"));
        $diff_date = (strtotime($cur_date)- strtotime($last_date))/24/3600;

        $form_details = ClientForm::where('client_id',$client_id);
        if ($from_date!='' and  $to_date!='')
        {
            $form_details = $form_details->whereRaw("str_to_date(date,'%d-%m-%Y') between str_to_date('".$from_date."','%d-%m-%Y') and str_to_date('".$to_date."','%d-%m-%Y')");
        }
        $form_details = $form_details->orderByRaw("str_to_date(date,'%d-%m-%Y') asc");
        $form_details = $form_details->get();

        // dd( $data_question,$form_details[0]->clientInapporiateBehavior[0]->behavior_other);
        return view('employee.client.reportDetails',compact('client_id','client_details','form_details','to_date','from_date','filter_by'));
    }
    public function reportAjaxPDF(Request $request)
    {
        if($request->ajax())
        {
            $client_id = $request->client_id;
            $filter_by = $request->filter_by;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $overallScoreChart = $request->overallScoreChart;
            $healthScoreChart = $request->healthScoreChart;
            $routineScoreChart = $request->routineScoreChart;
            $socialScoreChart = $request->socialScoreChart;
            $behaviorScoreChart = $request->behaviorScoreChart;
            $request->session()->put('client_id', $client_id);
            $request->session()->put('filter_by', $filter_by);
            $request->session()->put('from_date', $from_date);
            $request->session()->put('to_date', $to_date);
            $request->session()->put('overallScoreChart', $overallScoreChart);
            $request->session()->put('healthScoreChart', $healthScoreChart);
            $request->session()->put('routineScoreChart', $routineScoreChart);
            $request->session()->put('socialScoreChart', $socialScoreChart);
            $request->session()->put('behaviorScoreChart', $behaviorScoreChart);

            return $overallScoreChart;
        }
    }
    public function reportPDF()
    {
        $client_id = session('client_id');
        $filter_by = session('filter_by');
        if ($filter_by != '') {
            switch($filter_by) {
                case('Daily'):
                    $to_date = date('d-m-Y');
                    $from_date = date('d-m-Y');
                    break;
                case('Weekly'):
                    $to_date = date('d-m-Y');
                    $from_date = date('d-m-Y', strtotime('-7 days'));
                    break;
                case('Monthly'):
                    $to_date = date('d-m-Y');
                    $from_date = date("d-m-Y",strtotime("-1 month"));
                    break;
                case('Quarterly'):
                    $to_date = date('d-m-Y');
                    $from_date = date("d-m-Y",strtotime("-6 month"));
                    break;
                case('Yearly'):
                    $to_date = date('d-m-Y');
                    $from_date = date("d-m-Y",strtotime("-1 year"));
                    break;
                default:
                    $to_date = date('d-m-Y');
                    $from_date = date('d-m-Y');
            }
        }
        else {
            $to_date = session('to_date');;
            $from_date = session('from_date');;
        }
        
        $client_details = Client::where('client_id',$client_id)->first();

        $cur_date = date("Y-m-d");
        $last_date = date("Y-m-d",strtotime("-1 month"));
        $diff_date = (strtotime($cur_date)- strtotime($last_date))/24/3600;

        $form_details = ClientForm::where('client_id',$client_id);
        if ($from_date!='' and  $to_date!='')
        {
            $form_details = $form_details->whereRaw("str_to_date(date,'%d-%m-%Y') between str_to_date('".$from_date."','%d-%m-%Y') and str_to_date('".$to_date."','%d-%m-%Y')");
        }
        $form_details = $form_details->orderByRaw("str_to_date(date,'%d-%m-%Y') asc");
        $form_details = $form_details->get();
          
        $pdf = PDF::loadView('employee.client.reportPDF',compact('client_id','client_details','form_details','to_date','from_date','filter_by'));
    
        // return $pdf->download('itsolutionstuff.pdf');
        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        return $pdf->stream($client_details->client_fname.'-'.$client_details->client_sname.'.pdf',array("Attachment" => false));
    }
    public function reportAjaxPrint(Request $request)
    {
        if($request->ajax())
        {
            $client_id = $request->client_id;
            $filter_by = $request->filter_by;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $overallScoreChart = $request->overallScoreChart;
            $healthScoreChart = $request->healthScoreChart;
            $routineScoreChart = $request->routineScoreChart;
            $socialScoreChart = $request->socialScoreChart;
            $behaviorScoreChart = $request->behaviorScoreChart;
            $request->session()->put('client_id', $client_id);
            $request->session()->put('filter_by', $filter_by);
            $request->session()->put('from_date', $from_date);
            $request->session()->put('to_date', $to_date);
            $request->session()->put('overallScoreChart', $overallScoreChart);
            $request->session()->put('healthScoreChart', $healthScoreChart);
            $request->session()->put('routineScoreChart', $routineScoreChart);
            $request->session()->put('socialScoreChart', $socialScoreChart);
            $request->session()->put('behaviorScoreChart', $behaviorScoreChart);

            $client_id = session('client_id');
            $filter_by = session('filter_by');
            if ($filter_by != '') {
                switch($filter_by) {
                    case('Daily'):
                        $to_date = date('d-m-Y');
                        $from_date = date('d-m-Y');
                        break;
                    case('Weekly'):
                        $to_date = date('d-m-Y');
                        $from_date = date('d-m-Y', strtotime('-7 days'));
                        break;
                    case('Monthly'):
                        $to_date = date('d-m-Y');
                        $from_date = date("d-m-Y",strtotime("-1 month"));
                        break;
                    case('Quarterly'):
                        $to_date = date('d-m-Y');
                        $from_date = date("d-m-Y",strtotime("-6 month"));
                        break;
                    case('Yearly'):
                        $to_date = date('d-m-Y');
                        $from_date = date("d-m-Y",strtotime("-1 year"));
                        break;
                    default:
                        $to_date = date('d-m-Y');
                        $from_date = date('d-m-Y');
                }
            }
            else {
                $to_date = session('to_date');;
                $from_date = session('from_date');
            }
            
            $client_details = Client::where('client_id',$client_id)->first();

            $cur_date = date("Y-m-d");
            $last_date = date("Y-m-d",strtotime("-1 month"));
            $diff_date = (strtotime($cur_date)- strtotime($last_date))/24/3600;

            $form_details = ClientForm::where('client_id',$client_id);
            if ($from_date!='' and  $to_date!='')
            {
                $form_details = $form_details->whereRaw("str_to_date(date,'%d-%m-%Y') between str_to_date('".$from_date."','%d-%m-%Y') and str_to_date('".$to_date."','%d-%m-%Y')");
            }
            $form_details = $form_details->orderByRaw("str_to_date(date,'%d-%m-%Y') asc");
            $form_details = $form_details->get();
            
            return view('employee.client.reportPDF',compact('client_id','client_details','form_details','to_date','from_date','filter_by'));;
        }
    }
    public function reportExcel(Request $request)
    {
        $excel_dtl = ReportExcel::select('ex_d')->distinct('ex_d')->get();
        $client_dtl = ReportExcel::select('ex_c')->distinct('ex_c')->get();
        $report_dtl = ReportExcel::select('ex_c')->whereNotNull('client_id')->get();
        $na_report_dtl = ReportExcel::whereNotNull('client_id')
            ->where('ex_h','!=','Not Applicable (absent/sleeping)')
            ->get();
        return view('employee.client.reportExcel',compact('excel_dtl','client_dtl','report_dtl','na_report_dtl'));
    }
    public function reportExcelStore(Request $request)
    {
        Excel::import(new ReportImport,$request->file('excel_report'));
        $msg = [
            'title' => 'success',
            'text' => 'Excel Created successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function reportExcelEmployee(Request $request)
    {
        $excel_dtl = ReportExcel::where('employee_stat','A')->select('id','ex_d')->get();
        foreach ($excel_dtl as $key => $row) {
            $arr = explode(" ",$row->ex_d);
            $emp_fname = $arr[0];
            $cnt = Employee::where('emp_user_id',$emp_fname)->count();
            if (count($arr) > 1) {
                array_shift($arr);
                $emp_sname = implode(" ",$arr);
                // dd($emp_sname);
                // $cnt = $cnt->where('emp_sname',$emp_sname);
            }
            if ($cnt == 0) {
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
                //add employee into table
                $employee = new Employee;
                $employee->emp_id = $employee_id;
                $employee->site_id = 'S1';
                $employee->emp_fname = $emp_fname;
                $employee->emp_sname = $emp_sname;
                $employee->emp_user_id = $emp_fname;
                $employee->password = Hash::make('pass');
                $employee->save();

                ReportExcel::where('id',$row->id)->update(['employee_stat' => 'D']);
            }
        }
        $msg = [
            'title' => 'success',
            'text' => 'Excel Created successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function reportExcelClient(Request $request)
    {
        $excel_dtl = ReportExcel::select('id','ex_c','ex_d')->get();
        foreach ($excel_dtl as $key => $row) {
            $arr = explode(" ",$row->ex_c);
            $client_fname = $arr[0];
            $client_sname = '';
            $cnt = Client::where('client_fname',$client_fname);
            if (count($arr) > 1) {
                array_shift($arr);
                $client_sname = implode(" ",$arr);
                // dd($client_sname);
                $cnt = $cnt->where('client_sname',$client_sname);
            }
            $cnt = $cnt->count();
            if ($cnt == 0) {
                $emp_fname = explode(" ",$row->ex_d)[0];
                $emp_id = Employee::where('emp_user_id',$emp_fname)->value('emp_id');
                // if ($emp_id != '') {
                    //Client id creation start
                    $max_class = Client::select(DB::raw('MAX(CAST(SUBSTRING(client_id,2,length(client_id)-1) AS UNSIGNED)) as max_value'))->first();
                    if($max_class->max_value=="")
                    {
                        $client_id = "C1";
                    }
                    else
                    {
                        $lastp = $max_class->max_value;
                        $lastpp = ++$lastp;
                        $client_id = 'C'.$lastpp;
                    }
                    
                    //add employee into table
                    $client = new Client;
                    $client->client_id = $client_id;
                    $client->emp_id = $emp_id;
                    $client->site_id = 'S1';
                    $client->client_fname = $client_fname;
                    $client->client_sname = $client_sname;
                    $client->save();

                    ReportExcel::where('id',$row->id)->update(['client_stat' => 'D']);
                // }
            }
        }
        $msg = [
            'title' => 'success',
            'text' => 'Excel Created successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function reportExcelClientGenerate(Request $request)
    {
        $excel_dtl = ReportExcel::select('id','ex_c','ex_d')->get();
        foreach ($excel_dtl as $key => $row) {
            $arr = explode(" ",$row->ex_c);
            $client_fname = $arr[0];
            $client_id = Client::where('client_fname',$client_fname);
            if (count($arr) > 1) {
                array_shift($arr);
                $client_sname = implode(" ",$arr);
                // dd($client_sname);
                $client_id = $client_id->where('client_sname',$client_sname);
            }
            $client_id = $client_id->value('client_id');
            if ($client_id != '') {
                ReportExcel::where('id',$row->id)->update(['client_id' => $client_id]);
            }
        }
        $msg = [
            'title' => 'success',
            'text' => 'Excel Created successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    public function reportExcelFormGenerate(Request $request)
    {
        $excel_dtl = ReportExcel::select('client_id','ex_e')
            ->whereNotNull('client_id')
            ->groupBy('client_id','ex_e')
            ->get();
        // dd(count($excel_dtl));
        
        foreach ($excel_dtl as $key => $row) {
            $client_id = $row->client_id;
            $date = date('d-m-Y',strtotime($row->ex_e));
            $cnt = ClientForm::whereRaw("str_to_date(date,'%d-%m-%Y') = str_to_date('".$date."','%d-%m-%Y')")
                ->where('client_id',$client_id)
                ->count();
            // dd($cnt);
            if ($cnt == 0) {
                $medi_morning = explode("|",'N/A|0');
                $medi_afternoon = explode("|",'N/A|0');
                $medi_evening = explode("|",'N/A|0');
                $appo_stat = explode("|",'N/A|0');
                $teeth_morning = explode("|",'N/A|0');
                $teeth_evening = explode("|",'N/A|0');
                $shower_morning = explode("|",'N/A|0');
                $shower_evening = explode("|",'N/A|0');
                $bed_morning = explode("|",'N/A|0');
                $bed_evening = explode("|",'N/A|0');
                $clothes_morning = explode("|",'N/A|0');
                $clothes_evening = explode("|",'N/A|0');
                $floor_morning = explode("|",'N/A|0');
                $floor_evening = explode("|",'N/A|0');
                $bedtime_evening = explode("|",'N/A|0');
                $school_stat = explode("|",'N/A|0');
                $community_stat = explode("|",'N/A|0');
                $house_stat = explode("|",'N/A|0');
                $activities_stat = explode("|",'N/A|0');
                $family_stat = explode("|",'N/A|0');
                $caseworker_stat = explode("|",'N/A|0');
                $emotional_morning = explode("|",'Sad|0');
                $emotional_evening = explode("|",'Sad|0');
                $rule_stat = explode("|",'N/A|0');
                $instruction_stat = explode("|",'N/A|0');
                $behavior_stat = explode("|",'N/A|0');
                // dd($teeth_morning);
                //form id creation start
                $max_class = ClientForm::select(DB::raw('MAX(CAST(SUBSTRING(form_id,2,length(form_id)-1) AS UNSIGNED)) as max_value'))->first();
                if($max_class->max_value=="")
                {
                    $form_id = "F1";
                }
                else
                {
                    $lastp = $max_class->max_value;
                    $lastpp = ++$lastp;
                    $form_id = 'F'.$lastpp;
                }
                $today = Carbon::now()->format('Y-m-d h:i:s');
                //add form into table
                $form = new ClientForm;
                $form->form_id = $form_id;
                $form->client_id = $client_id;
                $form->date = $date;
                $form->save();

                $health = new ClientHealthStatus;
                $health->form_id = $form_id;
                $health->client_id = $client_id;
                $health->date = $date;
                $health->medi_morning = $medi_morning[0];
                $health->medi_morning_no = $medi_morning[1];
                $health->medi_afternoon = $medi_afternoon[0];
                $health->medi_afternoon_no = $medi_afternoon[1];
                $health->medi_evening = $medi_evening[0];
                $health->medi_evening_no = $medi_evening[1];
                $health->appo_stat = $appo_stat[0];
                $health->appo_stat_no = $appo_stat[1];
                $health->appo_other = '';
                $health->save();
                // health score
                $health_score = $medi_morning[1] + $medi_afternoon[1] + $medi_evening[1] + $appo_stat[1];
                $health_tot_score = 0;
                if ($medi_morning[1] != 0) {
                    $health_tot_score = $health_tot_score + 2;
                }
                if ($medi_afternoon[1] != 0) {
                    $health_tot_score = $health_tot_score + 2;
                }
                if ($medi_evening[1] != 0) {
                    $health_tot_score = $health_tot_score + 2;
                }
                if ($appo_stat[1] != 0) {
                    $health_tot_score = $health_tot_score + 2;
                }
                // dd('hiiiii');
                $routine = new ClientDailyRoutine;
                $routine->form_id = $form_id;
                $routine->client_id = $client_id;
                $routine->date = $date;
                $routine->teeth_morning = $teeth_morning[0];
                $routine->teeth_morning_no = $teeth_morning[1];
                $routine->teeth_evening = $teeth_evening[0];
                $routine->teeth_evening_no = $teeth_evening[1];
                $routine->shower_morning = $shower_morning[0];
                $routine->shower_morning_no = $shower_morning[1];
                $routine->shower_evening = $shower_evening[0];
                $routine->shower_evening_no = $shower_evening[1];
                $routine->bed_morning = $bed_morning[0];
                $routine->bed_morning_no = $bed_morning[1];
                $routine->bed_evening = $bed_evening[0];
                $routine->bed_evening_no = $bed_evening[1];
                $routine->clothes_morning = $clothes_morning[0];
                $routine->clothes_morning_no = $clothes_morning[1];
                $routine->clothes_evening = $clothes_evening[0];
                $routine->clothes_evening_no = $clothes_evening[1];
                $routine->floor_morning = $floor_morning[0];
                $routine->floor_morning_no = $floor_morning[1];
                $routine->floor_evening = $floor_evening[0];
                $routine->floor_evening_no = $floor_evening[1];
                $routine->bedtime_evening = $bedtime_evening[0];
                $routine->bedtime_evening_no = $bedtime_evening[1];
                $routine->save();
                // routine score
                $routine_score = $teeth_morning[1] + $teeth_evening[1] + 
                    $shower_morning[1] + $shower_evening[1] + 
                    $bed_morning[1] + $bed_evening[1] + 
                    $clothes_morning[1] + $clothes_evening[1] + 
                    $floor_morning[1] + $floor_evening[1] + 
                    $bedtime_evening[1];
                $routine_tot_score = 0;
                if ($teeth_morning[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($teeth_evening[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($shower_morning[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($shower_evening[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($bed_morning[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($bed_evening[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($clothes_morning[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($clothes_evening[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($floor_morning[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($floor_evening[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }
                if ($bedtime_evening[1] != 0) {
                    $routine_tot_score = $routine_tot_score + 2;
                }

                $social = new ClientSocialWellBeing;
                $social->form_id = $form_id;
                $social->client_id = $client_id;
                $social->date = $date;
                $social->school_stat = $school_stat[0];
                $social->school_stat_no = $school_stat[1];
                $social->community_stat = $community_stat[0];
                $social->community_stat_no = $community_stat[1];
                $social->house_stat = $house_stat[0];
                $social->house_stat_no = $house_stat[1];
                $social->activities_stat = $activities_stat[0];
                $social->activities_stat_no = $activities_stat[1];
                $social->family_stat = $family_stat[0];
                $social->family_stat_no = $family_stat[1];
                $social->family_other = '';
                $social->caseworker_stat = $caseworker_stat[0];
                $social->caseworker_stat_no = $caseworker_stat[1];
                $social->caseworker_other = '';
                $social->save();
                // social score
                $social_score = $school_stat[1] + $community_stat[1] + $house_stat[1] + $activities_stat[1] + $family_stat[1] + $caseworker_stat[1];
                $social_tot_score = 0;
                if ($school_stat[1] != 0) {
                    $social_tot_score = $social_tot_score + 2;
                }
                if ($community_stat[1] != 0) {
                    $social_tot_score = $social_tot_score + 2;
                }
                if ($house_stat[1] != 0) {
                    $social_tot_score = $social_tot_score + 2;
                }
                if ($activities_stat[1] != 0) {
                    $social_tot_score = $social_tot_score + 2;
                }
                if ($family_stat[1] != 0) {
                    $social_tot_score = $social_tot_score + 2;
                }
                if ($caseworker_stat[1] != 0) {
                    $social_tot_score = $social_tot_score + 2;
                }

                $general = new ClientGeneralObservation;
                $general->form_id = $form_id;
                $general->client_id = $client_id;
                $general->date = $date;
                $general->emotional_morning = $emotional_morning[0];
                $general->emotional_morning_no = $emotional_morning[1];
                $general->emotional_evening = $emotional_evening[0];
                $general->emotional_evening_no = $emotional_evening[1];
                $general->save();
                // general score
                $general_score = $emotional_morning[1] + $emotional_evening[1];
                $general_tot_score = 0;
                if ($emotional_morning[1] != 0) {
                    $general_tot_score = $general_tot_score + 2;
                }
                if ($emotional_evening[1] != 0) {
                    $general_tot_score = $general_tot_score + 2;
                }
                
                $behavior = new ClientBehavior;
                $behavior->form_id = $form_id;
                $behavior->client_id = $client_id;
                $behavior->date = $date;
                $behavior->rule_stat = $rule_stat[0];
                $behavior->rule_stat_no = $rule_stat[1];
                $behavior->instruction_stat = $instruction_stat[0];
                $behavior->instruction_stat_no = $instruction_stat[1];
                $behavior->behavior_stat = $behavior_stat[0];
                $behavior->behavior_stat_no = $behavior_stat[1];
                $behavior->save();
                // behavior score
                $behavior_score = $rule_stat[1] + $instruction_stat[1] + $behavior_stat[1];
                $behavior_tot_score = 0;
                if ($rule_stat[1] != 0) {
                    $behavior_tot_score = $behavior_tot_score + 3;
                }
                if ($instruction_stat[1] != 0) {
                    $behavior_tot_score = $behavior_tot_score + 3;
                }
                if ($behavior_stat[1] != 0) {
                    $behavior_tot_score = $behavior_tot_score + 3;
                }

                // $behavior_other = $behavior_other;
                $inapporiate_score = 0;
                // if (isset($behavior_other) && count($behavior_other) > 0) {
                //     foreach ($behavior_other as $key => $row) {
                //         if ($row != '') {
                //             $inapporiate = new ClientInapporiateBehavior;
                //             $inapporiate->form_id = $form_id;
                //             $inapporiate->client_id = $client_id;
                //             $inapporiate->date = $date;
                //             $inapporiate->behavior_other = $row;
                //             $inapporiate->behavior_other_no = $behavior_other_no[$key];
                //             $inapporiate->save();
                //             // inapporiate score
                //             $inapporiate_score += $behavior_other_no[$key];
                //         }
                //     }
                // }

                $tot_score = $health_score + $routine_score + $social_score + $general_score + $behavior_score + $inapporiate_score;
                $total_overalle_score = $health_tot_score + $routine_tot_score + $social_tot_score + $general_tot_score + $behavior_tot_score;
                // update total score
                $form = ClientForm::findOrFail($form_id);
                $form->score = $tot_score;
                $form->total_overalle_score = $total_overalle_score;
                $form->health_score = $health_score;
                $form->health_tot_score = $health_tot_score;
                $form->routine_score = $routine_score;
                $form->routine_tot_score = $routine_tot_score;
                $form->social_score = $social_score;
                $form->social_tot_score = $social_tot_score;
                $form->general_score = $general_score;
                $form->general_tot_score = $general_tot_score;
                $form->behavior_score = $behavior_score;
                $form->behavior_tot_score = $behavior_tot_score;
                $form->inapporiate_score = $inapporiate_score;
                $form->tot_behavior_score = ($behavior_score+$inapporiate_score);
                $form->save();
            }
        }
        $msg = [
            'title' => 'success',
            'text' => 'Excel Created successfully!',
            'icon' => 'success'
        ];
        return back()->with('status', $msg);
    }
    
}
