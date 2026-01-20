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
			 <h3 class="text-info text-center"><i class="fa fa-user-circle-o fa-1x"></i> HOD Information</h3>
            </div> 
 </div>
 <div class="col-md-12">
 {!! Form::open(['action' => array('ApproverController@update', $app->id),'method'=>'PUT']) !!}
 	<div class="form-horizontal">
 				<div class="form-group required">
						<label  class="control-label col-md-4  requiredField"><span class="fa fa-vcard-o text-primary"></span> HOD Name<span class="asteriskField">*</span></label>
						<div class="controls col-md-6" >
						{!! Form::text('hName',$app->name,array('class' => 'input-md form-control', 'required')); !!} 
						</div>					
				</div>		
 				<div class="form-group required">
						<label  class="control-label col-md-4  requiredField"><span class="fa fa-toggle-on text-primary"></span>HOD Email <span class="asteriskField">*</span></label>
						<div class="controls col-md-6" >
						{!! Form::text('hEmail',$app->email,array('class' => 'input-md form-control', 'required')); !!} 
						</div>							
					
				</div>		
 				<div class="form-group required">

						<label  class="control-label col-md-4  requiredField"><span class="fa fa-group text-primary"></span> Department<span class="asteriskField">*</span></label>
						<div class="controls col-md-6" >
						{!! Form::select('hDept',["PRODUCTION"=>"PRODUCTION","FINANCE"=>"FINANCE", "HR"=>"HR", "GA"=>"GA", "PURCHASING"=>"PURCHASING","MARKETING"=>"MARKETING","I.T"=>"I.T", "IMPORTATION"=>"IMPORTATION","SALES"=>"SALES","LOGISTIC"=>"LOGISTIC","AUDIT"=>"AUDIT"],$app->dept,array('class' => 'input-md form-control', 'required')); !!} 
						</div>							
					
				</div>					
 				<div id="div_id_select" class="form-group required">
						<label  class="control-label col-md-4  requiredField"><span class="fa fa-bank text-primary"></span> Company<span class="asteriskField">*</span></label>
						<div class="controls col-md-6" >
						{!! Form::select('company',["ALL"=>"ALL","ESRNL"=>"ESRNL","NPRNL"=>"NPRNL","PBNL"=>"PBNL","NBL"=>"NBL","PFNL"=>"PFNL"],$app->company,array('class' => 'form-control', 'required')); !!} 
						</div>				
						
				</div>
 				<div id="div_id_select" class="form-group required">

						<label  class="control-label col-md-4  requiredField"><span class="fa fa-street-view text-primary"></span> Location<span class="asteriskField">*</span></label>
						<div class="controls col-md-6" >
						{!! Form::select('location',["ALL"=>"ALL","APAPA"=>"APAPA","FACTORY"=>"FACTORY", "HEAD OFFICE"=>"HEAD OFFICE"],$app->location,array('class' => 'input-md form-control', 'required')); !!} 
						</div>	
						
				</div>	

						<div class="controls col-md-4 col-md-push-4" >
						{!! Form::submit('Update Profile',array('class' => 'btn btn-lg btn-primary')); !!} 
						</div>		
							
				
</div>	
 
 {!! Form::close() !!}
 </div>

@endsection