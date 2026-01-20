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
			 <h3 class="text-info text-center">Generate Report </h3>
            </div> 
 </div>
  <div class="col-md-12">
{{ Form::open(['route' => array('export.data'),'id'=>'reqstore', 'files'=>true, 'enctype'=>"multipart/form-data"]) }}
						<div class="form-group required" style="margin-bottom:20px">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-vcard-o text-primary"></span> Name <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::text('name',"",array('class' => 'input-md form-control')) }} 
						</div>			
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-university text-primary"></span> Company<span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::select('company',config('app.company'),"",array('class' => 'form-control')) }} 
						</div>		
						
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-group text-primary"></span> Department<span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::select('dept',config('app.department'),"",array('class' => 'form-control')) }} 
						</div>							
						</div>	
						<br>
						<br>
						<div class="form-group required" style="margin-bottom:20px">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-hourglass-start text-primary"></span> Status <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::select('status',config('app.status'),"",array('class' => 'form-control')) }} 
						</div>			
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-unsorted text-primary"></span> Category <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::select('category',config('app.category'),"",array('class' => 'form-control')) }} 
						</div>		
						
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-mouse-pointer  text-primary"></span> Application <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::select('application',config('app.apps'),"",array('class' => 'form-control')) }} 
						</div>							
				</div>				
				<br>
				
										<div class="form-group required" style="margin-bottom:20px">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa fa-caret-square-o-right text-primary"></span> From Date: <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::date('fDate',"",array('class' => 'form-control')) }} 
						</div>			
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-caret-square-o-left text-primary"></span>To Date: <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::date('tDate',"",array('class' => 'form-control')) }} 
						</div>		
						
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-reorder  text-primary"></span> Order: <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::select('order',[''=>'','ASC'=>'ASCENDING', 'DESC'=>'DESCENDING'],"",array('class' => 'form-control')) }} 
						</div>							
						</div>	
						<br>
						
					{{ Form::submit('Export Data',array('class' => 'btn btn-md btn-info text-left col-md-offset-1', 'id'=>'expData')) }} 
				
				
					{{ Form::button('Filter Search',array('class' => 'btn btn-md btn-info text-right col-md-offset-8', 'id'=>'repData')) }} 
					
					
  </div>
				{{ Form::close() }}
 </div>
					
 <hr />

 
 <div class="row">
 <div class="col-md-12">
	<table class="table table-md col-md-8 table-bordered table-stripped" id="table1" style="display:none">
	<thead>
	<tr>
	<th>S/N</th>
	<th>ID</th>
	<th>CODE</th>
	<th>DATE</th>	
	<th>NAME</th>
	<th>CATEGORY</th>	
	<th style="width: 20%">REQUEST</th>
	<th>COMPANY</th>	
	<th>DEPT</th>	
	<th class="col-lg-2 col-md-2">HOD</th>	
	<th style="width: 30%">STATUS</th>	


	</tr>
	
	</thead>
	<tbody id="tbody"> 
	
	
	</tbody>
	
	</table>
 </div>
 </div>
@endsection