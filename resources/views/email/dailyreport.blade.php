<html>
<head>
<style>
.table1 {
	border-collapse: collapse;
	}
.table1 th{

	border: 1px solid black
	}
.table1 td{

	border: 1px solid black
	}
</style>
</head>
<body>
Dear Admin,
<br>
<br>
<p>There are still IT Form request pending in the system, please find below list of incomplete request below and inform appropriate PIC for closure.
<br>
<br>

	<table class="table1">
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
	

	</tr>
	
	</thead>
	<tbody>
	@if(count($req)>0)
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
			echo '<b>'.$a.'</b>:'.$r->$a.'<br> '.' ';
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
	
	</tr>
	@endforeach
	@else
		<tr><td colspan="9">No pending request </td></tr>
	@endif
	</tbody>
	</table>
<br>
<br>
<p>IT Department</p>

<p>Best Regards, </p>

</body>
</html>