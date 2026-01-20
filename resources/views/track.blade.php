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
			 <h3 class="text-info text-center"> Request Tracking</h3>
            </div> 
 </div>
 <div class="col-md-12">
 @php 
 if(is_null($form->apprStatus)){
	 $pg = '25%';	 
	 $stat = "AWAITING HOD APPROVAL";
	 $color = "info";
 }
 elseif($form->apprStatus==10){
	 $pg = '50%';	 
	 $stat = "APPROVED BY HOD";	 
	 $color = "primary";	 
 }
  elseif($form->apprStatus==8){
	 $pg = '0%';	 
	 $stat = "DISMISSED BY HOD";	
	$color = "danger";	 
 }
  elseif($form->apprStatus==28){
	 $pg = '0%';	 
	 $stat = "DISMISSED BY IT-HOD";	 
	 $color = "danger";
 }
  elseif($form->apprStatus==30){
	 $pg = '75%';	 
	 $stat = "APPROVED BY IT-HOD";	
	 $color = "warning";	 
 }
  elseif($form->apprStatus==40){
	 $pg = '100%';	 
	 $stat = "COMPLETED";	 
	 $color = "success";
 }
 
 @endphp
<div class="progress">
  <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{$pg}}" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>

	<table class="table table-bordered table-stripped">
	<thead>
	<tr>
	<th>CODE</th>
	<th>DATE</th>	
	<th>NAME</th>	
	<th style="width: 15%"> REQUEST </th>
	<th>COMPANY</th>	
	<th>DEPT</th>	
	<th class="col-lg-2 col-md-2">HOD</th>	
	<th>STATUS</th>	

	</tr>
	
	</thead>
	<tbody>

	<tr>
	<td>{{ $form->eApp3 }}</td>
	<td>{{ $form->created_at }}</td>
	<td>{{ $form->fName.' '.$form->lName }}</td>
	<td>@php
	$arr = ['sir','email','net','hrms','sap','remote','ingress','spark', 'eLeave'];
	foreach($arr as $a){
		
		if($form->$a!=NULL){
			echo '<b>'.$a.'</b>:'.$form->$a.'<br><hr>'.' ';
		}
	}
	@endphp</td>
	<td>{{ $form->comp.' '.$form->loc }}</td>
	<td>{{ $form->dept }}</td>
	<td>@php
	$brr = explode(';',$form->hod);
	foreach($brr as $b){
	echo explode('@', $b)[0].'<br>';
	}
	@endphp</td>
	<td><b class="text-{{$color}}">
	{{ $stat}}</b>
	</td>	
	</tr>

	</tbody>
	</table>
	
 </div>		


 </div>




@endsection