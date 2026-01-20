<?php
use Carbon\Carbon;
use App\req;
use App\User;
use App\approver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\sendITHodEmail;
use App\Jobs\sendITAdminEmail;
use App\Jobs\sendHodConfirmEmail;
use App\Jobs\sendApproverEmail;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/user/update', function(Request $req){
	$u = user::find($req->id)->update([
		'name'=>$req->name,
		'email'=>$req->email,
		'password'=> bcrypt($req->password),
		'admin'=>$req->role]
	);
	//return $u;
	return redirect('/users')->with(['status'=>'User details updated successfully']);
});
Route::get('/users/delete', function(Request $req){
	$u = User::find($req->id);
	$u->delete();
	return redirect('/users')->with(['status'=>'User details deleted successfully', ]);
})->name('user.delete');
Route::get('/users/edit', function(Request $req){
	$u = User::find($req->id);
	return view('user.edit')->with(['users'=>$u]);
})->name('user.edit');
Route::post('/user/store', function(Request $req){
	$u = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
			'admin'=> $req->role
        ]);
		return redirect('/users')->with(['status'=>'User details created successfully', ]);
});
Route::get('/users', function(Request $req){
	$u = User::get();
	return view('user.list')->with(['users'=>$u]);
})->name('users.list')->middleware('auth');
Route::get('/user/new', function(Request $req){
	return view('user.new');
})->name('user.register');
Route::get('/dailyreport', function(Request $req){
		$r = req::whereNotIn('apprStatus', [8, 28, 40])->get();
		$u = User::where('admin', 1)->get();		
		//Mail::to($user->email)->send(new sendDailyPendingMail($r, $u, $user))
	
	   return view('email.dailyreport')->with(['req'=>$r, 'users'=>$u]);
});
Route::post('/exportdata', function(Request $req){
	$r = new req;
	$q = $r->newQuery();
		if($req->has('fDate')){		
		$q->where('created_at','>=', date('m/d/Y', strtotime($req->fDate)));
	}	
		if($req->has('tDate')){		
		$q->where('created_at','<=', date('m/d/Y', strtotime($req->tDate)));
	}		
	if($req->has('category')){		
		$q->where('status', $req->category);
	}
	if($req->has('name')){		
		$q->where('fName', 'LIKE', '%'.$req->name.'%')->orWhere('lName', 'LIKE', '%'.$req->name.'%');
	}
	if($req->has('company')){		
		$q->where('comp', $req->company);
	}
	if($req->has('dept')){		
		$q->where('dept', $req->dept);
	}		
	if($req->has('status')){		
		$q->where('apprStatus', $req->status);
	}		
	if($req->has('category')){		
		$q->where('status', $req->category);
	}	
	
	if($req->has('application')){		
	$q->where($req->application,'!=', NULL);
		
	}
	if($req->has('order')){		
	$q->orderBy('created_at', $req->order);
		
	}
			$data = $q->get();
			$r=$data;
			$data = $data->toArray();
			$row = array('S/N', 'ID', 'CODE', 'NAME', 'DATE', 'CATEGORY', 'REQUEST', 'COMPANY', 'DEPARTMENT', 'HOD', 'STATUS');	
			return Excel::create('itform_report', function($excel) use ($data,  $r) {
			$excel->sheet('mySheet', function($sheet) use ($data, $r)
	        {
			$sheet->row(1,  array('S/N', 'ID', 'CODE', 'NAME', 'DATE', 'CATEGORY', 'REQUEST', 'COMPANY', 'DEPARTMENT', 'HOD', 'STATUS'));
			
			$stats="";
			
			foreach($r as $key=>$d){
				
					if($d->apprStatus==8){
					$stats = "DISMISSED BY HOD";	
					}
					else if($d->apprStatus==10){
						$stats="APPROVED BY HOD";						
					}
					else if($d->apprStatus==28){
						$stats="DISMISSED BY IT-HOD";
					}
					else if($d->apprStatus==30){
						$stats="APPRROVED BY IT-HOD";
					}
					else if($d->apprStatus==40){
						$stats="COMPLETED";
					}
					else{
						$stats= "AWAITING HOD APPROVAL";						
					}				
						$str ='';
						$arr = ['sir','email','net','hrms','sap','remote','ingress','spark', 'eLeave'];
						foreach($arr as $a){
							
							if($d->$a!=NULL){
								if($d->{$a.'text'}!=null){
									$str.= strtoupper($a).':'.$d->$a.' - '.$d->{strtolower($a.'text')}."\n";
				
								}
								else{
									$str.= strtoupper($a).':'.$d->$a."\n";
							
								}
							}
						}
			$sheet->appendRow(array(($key+1),$d->id,$d->eApp3, $d->fName.' '.$d->lName, $d->created_at, $d->status, $str , $d->comp,$d->dept, $d->eApp1, $stats  ));	
				
			}
	        });

		})->export('csv');	
	
	
})->name('export.data');
Route::get('/getrepdata', function(Request $req){
	$r = new req;
	$q = $r->newQuery();
	if($req->has('fDate')){		
		$q->where('created_at','>=', date('m/d/Y', strtotime($req->fDate)));
	}	
		if($req->has('tDate')){		
		$q->where('created_at','<=', date('m/d/Y', strtotime($req->tDate)));
	}	
	if($req->has('name')){		
		$q->where('fName', 'LIKE', '%'.$req->name.'%')->orWhere('lName', 'LIKE', '%'.$req->name.'%');
	}
	if($req->has('company')){		
		$q->where('comp', $req->company);
	}
	if($req->has('dept')){		
		$q->where('dept', $req->dept);
	}		
	if($req->has('status')){		
		$q->where('apprStatus', $req->status);
	}		
	if($req->has('category')){		
		$q->where('status', $req->category);
	}	
	if($req->has('application')){		
	$q->where($req->application,'!=', NULL);
		
	}
		if($req->has('order')){		
	$q->orderBy('created_at', $req->order);
		
	}
		$data = $q->get();

	return Response::json($data);

});
Route::get('/viewemail', function(Request $req){
	$r = req::find($req->id);
	
	return view('email.approve')->with(['key'=>0, 'form'=>$r]);
});
Route::get('/newsendIThodemail', function(Request $req){
	$r = req::find($req->id);
	$remail = env('itHodEmails');
	$r->save();
	$email = explode(',',$remail);
	foreach($email as $g){
	dispatch(new sendITHodEmail($r, $g));
				}	
	return redirect('/')->with('status', "Request sent successful to ".$remail);
	});
Route::get('/newsendhodemail', function(Request $req){
		$form = req::find($req->id);
		$app = approver::where('dept', $form->dept)->whereIn('company', [$form->comp, 'ALL'])->get();
		if(is_null($form->hod)){
		$arr=[];
		if(count($app)>1){
			$arr = [];
			foreach($app as $b){
				array_push($arr, $b->email);				
			}
			$form->hod = implode($arr, ';');
		}else{
		array_push($arr, $app[0]->email);		
		$form->hod = implode($arr, ';');		
		}
		}
		if($app==null){
		$app = approver::where('dept', $form->dept)->first();	
		$form->hod = $app->email.';';			
		}
		if($req->status=='REPORT'){
			$form->hod = env('hodreport'); // "herry.wijayanto@natural-prime.com";
		}
		$form->save();

		if($req->status=='REPORT'){		
				dispatch((new sendApproverEmail($form, 0))->delay(Carbon::now()->addMinutes(2)));
				}
		else{
			if(count($app)>1){
				foreach($app as $key=>$b){
				dispatch((new sendApproverEmail($form, $key))->delay(Carbon::now()->addMinutes(2)));
				}
			}else{
				dispatch((new sendApproverEmail($form, 0))->delay(Carbon::now()->addMinutes(2)));				
			}
		}
		return redirect('/')->with('status', "Request sent successful to ".$form->hod);
});
Route::get('/sendhodemail', function(Request $req){
	$form = req::find($req->id);
	$app = approver::where('dept', $form->dept)->whereIn('company', [$form->comp, 'ALL'])->first();
	$form->hod = $app->email;
		if($app==null){
		$app = approver::where('dept', $form->dept)->first();	
		$form->hod = $app->email;			
		}
		if($form->status=='REPORT'){
			$form->hod = env('hodreport'); //"herry.wijayanto@natural-prime.com";
		}
		$form->save();

		if($req->status=='REPORT'){		
		dispatch(new sendReportEmail($form));
		}
		else{
		dispatch(new sendApproverEmail($form));
		}
		return redirect('/')->with('status', "Email successfully sent to ".$form->hod);
				
	
});
Route::resource('approver', 'ApproverController', ['parameters'=>['approver'=>'id']]);
Route::get('/completed',['as' => 'complete', 'uses' => 'ReqController@complete']);
Route::get('/happrove', function(Request $req){
	$r = req::find($req->id);
	
	if ($req->cmd=="cancel"){
	$r->remarks = $req->rem;
	$r->apprStatus = 28;
	$r->approval = "DISMISSED";
	$r->eApp5 = date("m/d/y g:i:sA");
	$r->eApp7 = $req->email;
	$r->save();
	}
	else{
	//$r->remarks = $req->rem;
	if($r->apprStatus > 29){   //check if already approved
	return Response::json(["message"=>"Already been approved by ".$r->eApp7]);
	}else{						//Approval area of the code
	$r->apprStatus = 30;
	$r->approval = "APPROVED";	
	$r->eApp7 = $req->email;
	$r->eApp5 = date("m/d/y g:i:sA");
	$remail = env('itAdmin');//"taofik.alli-balogun@natural-prime.com";
	$email = explode(',',$remail);
	//$r->remarks = $req->sites;
	foreach($email as $g){
	dispatch(new sendITAdminEmail($r, $g));
				}
	$r->save();
	//dispatch(new sendITHodEmail($r))
	return Response::json(["message"=>""]);
	}  
	
	}	
	return Response::json(["message"=>""]);
	//return response('approver')->with('form', $r);
});
Route::get('/approve', function(Request $req){

	$r = req::find($req->id);
	$hod = explode(';', $r->hod)[$req->ky];
	if ($req->cmd=="cancel"){
	$r->remarks = $req->rem;
	$r->apprStatus = 8;
	$r->eApp1 = $hod;
	$r->eApp4 = date("m/d/y g:i:sA");
	$r->approval = "DISMISSED";
	$r->save();
	}
	else{
	//$r->remarks = $req->rem;
	if($r->apprStatus > 9){   //check if already approved
	return Response::json(["message"=>"Already been approved by ".$hod ]);
	}else{						//Approval area of the code
	$r->apprStatus = 10;
	$r->approval = "APPROVED";	
	$r->eApp1 =  $hod;
	$r->eApp4 = date("m/d/y g:i:sA");
	$r->eApp6 = $req->sites;
	$remail = env('itHodEmails'); //"yonatan.refa@esrnl.com,herry.wijayanto@natural-prime.com,taofik.alli-balogun@natural-prime.com";//"taofik.alli-balogun@natural-prime.com,hallitee_2005@yahoo.com";//
	$r->save();
	$email = explode(',',$remail);
	foreach($email as $g){
	dispatch(new sendITHodEmail($r, $g));
				}
	return Response::json(["message"=>""]);
	}  
	
	}

	return Response::json(["message"=>""]);
	//return response('approver')->with('form', $r);
});
Route::get('/hod/appr', function(Request $req){
	$r = req::find($req->id);
	return view('approver')->with(['form'=>$r,'ky'=>$req->ky]);
});
Route::get('/appr', function(Request $req){
	$r = req::find($req->id);
	return view('hod')->with(['form'=>$r,'email'=>$req->email]);
});
Route::get('/getapprover', function (Request $form) {
	if($form->comp=='EIL'){
	$data = approver::where('company', 'EIL')->whereIn('dept', [$form->dept, 'ALL'])->whereIn('location', [$form->location, 'ALL'])->get();
	}else{
		$data = approver::where('dept', $form->dept)->whereIn('company', [$form->comp, 'ALL'])->get();
	}
	return response()->json($data);
});
Route::get('/download', function (Request $req) {
  // $s = Storage::disk("MyDiskDriver")->get($req->selFile);
  // return view('home');
   // return Storage::download($req->selFile);
	$url = public_path()."\uploads\\".$req->selFile;
	$ext = explode('.', $req->selFile)[1];
	return response()->download($url, 'template.'.$ext);
});
Route::get('/', function () {
    return view('home');
});
Route::get('/hodemail', function(Request $req){
	$r = req::find($req->id);
	return view('email.hod')->with(['form'=>$r,'email'=>'taofik.alli-balogun@natural-prime.com']);
});
Route::get('/email', function(Request $req){
	$r = req::find($req->id);
	return view('email.approve')->with('form', $r);
});
Route::get('/report', function(Request $req){
	$r = req::find($req->id);
	return view('email.report')->with('form', $r);
});
Route::resource('form', 'ReqController', ['parameters'=>['req'=>'id']]);
Route::get('/actions', 'ReqController@admin')->name('');
Route::get('/track', 'ReqController@search')->name('tracker');
Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});
Route::get('/report', 'ReqController@report')->name('rep')->middleware('auth');
Route::get('/export', 'ReqController@exportdata')->name('export');
Route::get('/dashboard', 'ReqController@index')->name('dash')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/get-hod-email', [ApproverController::class, 'getHodEmail']);
