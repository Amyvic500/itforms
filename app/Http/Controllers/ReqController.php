<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\req;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use App\approver;
use Illuminate\Http\Request;
use App\Jobs\sendApproverEmail;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\sendReportEmail;
use App\Http\Requests\groupReq;
use App\Jobs\sendHodConfirmEmail;
use App\Jobs\sendApplicationEmail;
use App\Jobs\sendITHodEmail;
use App\Jobs\sendITAdminEmail;
use Illuminate\Support\Facades\Validator;

class ReqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random_code($length)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
    }

    public function report()
    { 
        return view('report');
    }

    public function index()
    {
        $req = req::orderBy('created_at', 'DESC')->paginate(20);
        return view('dash')->with(['req'=>$req]);
    }

    public function exportdata()
    {
        $data = req::orderBy('created_at', 'DESC')->get();
        
        $row = array('S/N','CODE','DATE','NAME','REQUEST','COMPANY','DEPARTMENT','HOD','STATUS');
        Excel::create('itform_report', function($excel) use ($data, $row) {
            $excel->sheet('mySheet', function($sheet) use ($data, $row) {
                $sheet->row(1, $row);
                foreach($data as $key=>$d){    
                    if(is_null($d->apprStatus)){
                        $pg = '25%';     
                        $stat = "AWAITING HOD APPROVAL";
                        $color = "info";
                    }
                    elseif($d->apprStatus==10){
                        $pg = '50%';     
                        $stat = "APPROVED BY HOD";     
                        $color = "primary";     
                    }
                    elseif($d->apprStatus==8){
                        $pg = '0%';     
                        $stat = "DISMISSED BY HOD";    
                        $color = "danger";     
                    }
                    elseif($d->apprStatus==28){
                        $pg = '0%';     
                        $stat = "DISMISSED BY IT-HOD";     
                        $color = "danger";
                    }
                    elseif($d->apprStatus==30){
                        $pg = '75%';     
                        $stat = "APPROVED BY IT-HOD";    
                        $color = "warning";     
                    }
                    elseif($d->apprStatus==40){
                        $pg = '100%';     
                        $stat = "COMPLETED";     
                        $color = "success";
                    }
 
                    $arr = ['sir','email','net','hrms','sap','remote','ingress','spark', 'eLeave'];
                    $str="";
                    foreach($arr as $a){
                        if($d->$a!=NULL){
                            $str.=$a.':'.$d->$a.', ';
                        }
                    }        
                    $brr = '';
                    $hod = '';
                    $brr = explode(';',$d->hod);
                    foreach($brr as $b){
                        $hod.=explode('@', $b)[0].' ';
                    }
            
                    $sheet->appendRow(array(($key+1), $d->eApp3, $d->created_at, $d->fName.' '.$d->lName, $str, $d->comp.' '.$d->loc, $d->dept, $hod, $stat));    
                }
            });
        })->export('csv');
    }    

    public function complete(Request $req){
        $r = req::find($req->id);
        $r->apprStatus = 40;
        $r->approval = "COMPLETED";
        $r->save();
        $remail = $r->hod;
        $email = explode(';',$remail);    
        foreach($email as $g){
            dispatch(new sendHodConfirmEmail($r, $g));
        }    
        return redirect('/')->with(['status'=>'Notification sent to requestor department successfully','alert'=>'success']);
    }

    public function create()
    {
        //
    }

    public function admin(Request $req)
    {
        $form = req::find($req->id);
        if($req->action=='email'){
            $app = approver::where('dept', $form->dept)->whereIn('company', [$form->comp, 'ALL'])->get();    
            if($app->isEmpty()){
                $app = approver::where('dept', $form->dept)->first();    
                $form->hod = $app ? $app->email.';' : null;            
            }
            if(is_null($form->hod)){                    
                $arr=[];
                if($app->count()>1){
                    $arr = [];
                    foreach($app as $b){
                        array_push($arr, $b->email);                
                    }
                    $form->hod = implode($arr, ';');
                }else{
                    array_push($arr, $app[0]->email);        
                    $form->hod = implode($arr, ';');        
                }
                if($req->status=='REPORT'){
                    $form->hod = env('hodreport');
                }
                $form->save();
            }            
            if($form->apprStatus==NULL){
                if(is_null($form->hod)){
                    foreach($app as $key=>$b){
                        dispatch((new sendApproverEmail($form, $key))->delay(Carbon::now()->addMinutes(2)));
                    }
                }else{
                    $email = explode(';',$form->hod);
                    foreach($email as $key=>$b){
                        dispatch((new sendApproverEmail($form, $key))->delay(Carbon::now()->addMinutes(2)));
                    }     
                }
            }
            elseif($form->apprStatus==10){
                $remail = env('itHodEmails');
                $email = explode(',',$remail);
                foreach($email as $g){
                    dispatch(new sendITHodEmail($form, $g));
                }                    
            }
            elseif($form->apprStatus==30){
                $remail = env('itAdmin');
                $email = explode(',',$remail);
                foreach($email as $g){
                    dispatch(new sendITAdminEmail($form, $g));
                }                    
            }
            elseif($form->apprStatus==40){
                $remail = $form->hod;
                $email = explode(';',$remail);    
                foreach($email as $g){
                    dispatch(new sendHodConfirmEmail($form, $g));
                }                    
            }        
            return redirect('/dashboard')->with(['status'=>'Notification email sent successfully.', 'alert'=>'success']);
        }
        else{
            return view('printout')->with('form', $form);
        }
    }    

    public function search(Request $req)
    {
        if(empty($req->search)){
            return redirect('/')->with(['status'=>'Please check request code again.', 'alert'=>'danger']);    
        }else{
            $form = req::where('eApp3','=',$req->search)->first();
        }
        
        if(empty($form) || is_null($form)){
            return view('home')->with(['status'=>'Please check request code again.','alert'=>'danger']);    
        }
        else{
            return view('track')->with(['form'=>$form]);
        }
    }

    public function store(groupReq $req)
    {
        $count = 0;
        $code = strtoupper($this->random_code(8));
        $form = new req;
        $form->fName = $req->firstName;
        $form->lName = $req->lastName;
        $form->comp = $req->company;
        $form->loc = $req->location;
        $form->dept = $req->dept;
        $form->post = $req->position;
        $form->status = $req->status;
        $form->curr = $req->req;    
        $form->existed = $req->existed;        
        $form->eApp3 = $code;
        $form->userEmail = $req->userEmail;
        $form->extNum = $req->extNum;

        if($req->status=='REPORT'){
            $form->repFormat = $req->repFormat;
            $form->selApp = $req->selApp;
            if($req->has('selFile')){
                $path = Storage::disk('MyDiskDriver')->putFile('/', $req->file('selFile')); 
                $form->selFile = $path;        
            }
        }
        else if($req->status=='APPLICATION'){
            $form->repFormat = $req->repFormat;
            $form->selApp = $req->selApp1;
            if($req->has('selFile1')){
                $path = Storage::disk('MyDiskDriver')->putFile('/', $req->file('selFile1'));
                $form->selFile = $path;    
            }
        }        
        else{
            if($req->has('sir')){
                $form->sir = $req->sir;
                if($req->has('sirdelete')){
                    $form->sirtext = $req->sirdelete;
                } elseif($req->has('sirreset')){
                    $form->sirtext = $req->sirreset;
                }
                elseif($req->has('sirexisting')){
                    $form->sirtext = $req->sirexisting;
                }
            }else{ $count++; }
            
            if($req->has('email')){
                $form->email = $req->email;
                if($req->has('emaildelete')){
                    $form->emailtext = $req->emaildelete;
                } elseif($req->has('emailreset')){
                    $form->emailtext = $req->emailreset;
                }
                elseif($req->has('emailexisting')){
                    $form->emailtext = $req->emailexisting;
                }
            }else{ $count++; }        
            
            if($req->has('net')){
                $form->net = $req->net;
                if($req->has('netdelete')){
                    $form->nettext = $req->netdelete;
                } elseif($req->has('netreset')){
                    $form->nettext = $req->netreset;
                }
                elseif($req->has('netexisting')){
                    $form->nettext = $req->netexisting;
                }
            }else{ $count++; }
            
            if($req->has('rem')){
                $form->remote = $req->rem;
                if($req->has('remdelete')){
                    $form->remotetext = $req->remdelete;
                } elseif($req->has('remreset')){
                    $form->remotetext = $req->remreset;
                }
                elseif($req->has('remexisting')){
                    $form->remotetext = $req->remexisting;
                }                    
            }else{ $count++; }
            
            if($req->has('eleave')){
                $form->eLeave = $req->eleave;
                if($req->has('eleavedelete')){
                    $form->eleavetext = $req->eleavedelete;
                } elseif($req->has('eleavereset')){
                    $form->eleavetext = $req->eleavereset;
                }
                elseif($req->has('eleaveexisting')){
                    $form->eleavetext = $req->eleaveexisting;
                }
            }else{ $count++; }
            
            if($req->has('sap')){
                $form->sap = $req->sap;        
                if($req->has('sapdelete')){
                    $form->saptext = $req->sapdelete;
                } elseif($req->has('sapreset')){
                    $form->saptext = $req->sapreset;
                }        
                elseif($req->has('sapexisting')){
                    $form->saptext = $req->sapexisting;
                }
            }else{ $count++; }
            
            if($req->has('spark')){
                $form->spark = $req->spark;
                if($req->has('sparkdelete')){
                    $form->sparktext = $req->sparkdelete;
                } elseif($req->has('sparkreset')){
                    $form->sparktext = $req->sparkreset;
                }
                elseif($req->has('sparkexisting')){
                    $form->sparktext = $req->sparkexisting;
                }                                            
            }else{ $count++; }
            
            if($req->has('ingress')){
                $form->ingress = $req->ingress;
                if($req->has('ingressdelete')){
                    $form->ingresstext = $req->ingressdelete;
                } elseif($req->has('ingressreset')){
                    $form->ingresstext = $req->ingressreset;
                }
                elseif($req->has('ingressexisting')){
                    $form->ingresstext = $req->ingressexisting;
                }                    
            }else{ $count++; }
            
            if(($count==8) && ($req->status!='APPLICATION') && ($req->status!='REPORT')){
                $count=0;
                return redirect()->back()->withInput()->with(['status'=>'Error! application not selected.', 'alert'=>'danger']);
            }else{ $count=0; }
        }

        $form->notes = $req->notes;
        
        if($form->comp=='EIL'){
            $app = approver::where('company', 'EIL')
                ->whereIn('dept', [$req->dept, 'ALL'])
                ->whereIn('location', [$req->location, 'ALL'])
                ->get();
        }
        else{
            $app = approver::where('dept', $form->dept)
                ->whereIn('company', [$form->comp, 'ALL'])
                ->get();
        }

        if($app->isEmpty()){
            return redirect()->back()->withInput()->with([
                'status' => 'Error! No approver found for your department/company.', 
                'alert' => 'danger'
            ]);
        }

        $arr = [];
        if($app->count()>1){
            foreach($app as $b){
                array_push($arr, $b->email);                
            }
            $form->hod = implode($arr, ';');
        }else{
            array_push($arr, $app[0]->email);        
            $form->hod = implode($arr, ';');        
        }

        if($req->status=='REPORT'){
            $form->hod = env('hodreport');
            $form->approval = "COMPLETED";
            $form->apprStatus = 40;
        }
        if($req->status=='APPLICATION'){
            $form->hod = env('hodreport');
            $form->approval = "COMPLETED";
            $form->apprStatus = 40;
        }    
        
        $form->save();

        if($req->status=='REPORT'){        
            dispatch(new sendReportEmail($form, 0));
        }
        else if($req->status=='APPLICATION'){        
            dispatch(new sendApplicationEmail($form));
        }        
        else{
            if($app->count()>1){
                foreach($app as $key=>$b){
                    dispatch((new sendApproverEmail($form, $key))->delay(Carbon::now()->addMinutes(1)));
                }
            }else{
                dispatch(new sendApproverEmail($form, 0));
            }
        }

        return redirect('/')->with([
            'status'=>"Your request code:".$form->eApp3." , please note down the code to track your request. Request sent successful to ".$form->hod.", please follow up with your HOD for approval.", 
            "alert"=>"success"
        ]);
    }

    public function show(Request $request)
    {
        //
    }

    public function edit(Request $request)
    {
        //
    }

    public function update(Request $request, req $req)
    {
        //
    }

    public function destroy(Request $request)
    {
        //
    }
}