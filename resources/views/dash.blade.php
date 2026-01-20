@extends('layouts.app1')

@section('content')

<div class="row">
 <div class="col-md-12">
			<div class="page-header">
			@if (session('status'))
				<div class="alert alert-success h4 text-center">
					{{ session('status') }}
				</div>
			@endif			
			 <h3 class="text-info text-center"> Request List</h3>
            </div> 
 </div>
 <div class="col-md-12">
	<table class="table table-bordered table-stripped">
	<thead>
	<tr>
	<th>S/N</th>
	<th>CODE</th>
	<th>DATE</th>	
	<th>NAME</th>	
	<th style="width: 20%">REQUEST</th>
	<th>COMPANY</th>	
	<th>DEPT</th>	
	<th class="col-lg-2 col-md-2">HOD</th>	
	<th style="width: 30%">STATUS</th>	
	<th>ACTION</th>	

	</tr>
	
	</thead>
	<tbody>
	@foreach($req as $r)
	
	@php
 if(is_null($r->apprStatus)){
	 $pg = '25%';	 
	 $stat = "AWAITING HOD APPROVAL";
	 $color = "info";
 }
 elseif($r->apprStatus==10){
	 $pg = '50%';	 
	 $stat = "APPROVED BY HOD";	 
	 $color = "primary";	 
 }
  elseif($r->apprStatus==8){
	 $pg = '0%';	 
	 $stat = "DISMISSED BY HOD";	
	$color = "danger";	 
 }
  elseif($r->apprStatus==28){
	 $pg = '0%';	 
	 $stat = "DISMISSED BY IT-HOD";	 
	 $color = "danger";
 }
  elseif($r->apprStatus==30){
	 $pg = '75%';	 
	 $stat = "APPROVED BY IT-HOD";	
	 $color = "warning";	 
 }
  elseif($r->apprStatus==40){
	 $pg = '100%';	 
	 $stat = "COMPLETED";	 
	 $color = "success";
 }
 @endphp	
	
	
	<tr>
	<td>{{ $loop->iteration }}</td>
		<td>{{ $r->eApp3 }}</td>
	<td>{{ $r->created_at }}</td>
	<td>{{ $r->fName.' '.$r->lName }}</td>
	<td>@php
	$arr = ['sir','email','net','hrms','sap','remote','ingress','spark', 'eLeave'];
	foreach($arr as $a){
		
		if($r->$a!=NULL){
			if($a=='eLeave'){
			echo '<b>'.'E-Leave'.'</b>:'.$r->$a.'<br> '.' ';
			}
			else{
				echo '<b>'.$a.'</b>:'.$r->$a.'<br> '.' ';
			}
		}
	}
	@endphp</td>
	<td>{{ $r->comp.' '.$r->loc }}</td>
	<td>{{ $r->dept }}</td>
	<td>@php
	$brr = explode(';',$r->hod);
	foreach($brr as $b){
	echo explode('@', $b)[0].'<br>';
	}
	@endphp</td>
	<td>
	<b class="text-{{$color}}">{{ $stat }}</b>
	</td>
	<td>
								{!! Form::open(['action' => array('ReqController@admin'),'method'=>'GET']) !!}
								<input name='id' value={{$r->id}} hidden>
                                <span class="input-group-btn">
								@if($r->apprStatus!=40) 
									@if(($r->apprStatus!=8)|| ($r->apprStatus!=28))
								<button name="action" value="email" class="btn btn-danger btn-sm" type="submit">MAIL                         
                                </button>
									@endif
								@endif
								<button name="action" value="print" class="btn btn-primary btn-sm" type="submit">            PRINT              
                                </button>	
								</span>
								{!! Form::close() !!}
	</td>	
	</tr>
	@endforeach
	</tbody>
	</table>
	
 </div>		
<div class="col-sm-12 col-md-12">
 <div class="col-sm-6 col-md-6">{{ $req->links() }}</div><div class="col-sm-6 col-md-6"><a href="{{ route('export')  }}"><button class="btn btn-primary">Export Data</button></a></div>
 
 </div>

</div>


@endsection