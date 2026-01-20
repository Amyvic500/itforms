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
			 <h3 class="text-info text-center"><i class="fa fa-user-circle-o fa-1x"></i> User Information</h3>
            </div> 
 </div>
 <div class="col-md-12">
 {!! Form::open(['action' => array('ReqController@store'),'method'=>'POST']) !!}
	<div class="form-horizontal">
	<input value="{{ $form->id}}" id="formid" hidden/>
 				<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-vcard-o text-primary"></span> First Name<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!! Form::text('firstName',$form->fName,array('class' => 'input-md form-control', 'readonly')); !!} 
						</div>		
	
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-vcard text-primary"></span>  Last Name<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!! Form::text('lastName',$form->lName,array('class' => 'input-md form-control', 'readonly')); !!} 
						</div>				
				</div>		
		
 				<div id="div_id_select" class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-bank text-primary"></span> Company<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!!Form::text('location',$form->comp,array('class' => 'input-md form-control', 'readonly')); !!}
						</div>				

						<label  class="control-label col-md-2  requiredField"><span class="fa fa-street-view text-primary"></span> Location<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!! Form::text('location',$form->loc,array('class' => 'input-md form-control','readonly')); !!} 
						</div>	
						
				</div>
 				<div class="form-group required">

						<label  class="control-label col-md-2  requiredField"><span class="fa fa-group text-primary"></span> Department<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!! Form::text('dept',$form->dept,array('class' => 'input-md form-control', 'readonly')); !!} 
						</div>	
						
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-toggle-on text-primary"></span> Position<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!! Form::text('position',$form->post,array('class' => 'input-md form-control', 'readonly')); !!} 
						</div>		
					
				</div>	
 				<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-unsorted text-primary"></span> Status<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!! Form::text('status',$form->status,array('class' => 'input-md form-control', 'readonly')); !!} 
						</div>		
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-plus-circle text-primary"></span> current<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{!! Form::text('req',$form->curr,array('class' => 'input-md form-control', 'readonly')); !!} 
						</div>						
				</div>					
</div>				
 </div>
  <div class="col-md-12">
			<div class="page-header">
			
			 <h3 class="text-info text-center"><i class="fa fa-language fa-1x"></i> Request Details</h3>
            </div> 
 </div>
  <div class="col-md-12">
<div class="form-inline">
				<div class="form-group">
						<label  class="control-label col-md-3  requiredField"><span class="fa fa-mail-reply text-primary"></span> SIR </label>
						<div class="controls col-md-3 col-md-pull-1" >
							{!!	Form::radio('sir', 'New ID',$form->sir=='New ID',array('class' => 'input-md col-md-2 control-label') ) !!}
							<span class="control-label col-md-10 text-left">New ID</span>
							{!!	Form::radio('sir', 'Delete ID',$form->sir=='Delete ID',array('class' => 'input-md col-md-2 control-label') ) !!}
							<span class="control-label col-md-10">Delete ID</span>
							{!!	Form::radio('sir', 'Change Password',$form->sir=='Change Password',array('class' => 'input-md col-md-2 control-label') ) !!}
							<span class="control-label col-md-10">Change Password</span>
							
						</div>		
	
						<label  class="control-label col-md-3  requiredField"><span class="fa fa-envelope-open-o text-primary"></span> Email Address </label>
						<div class="controls col-md-3 col-md-pull-1" >
							{!!	Form::radio('email', 'New ID',$form->email=='New ID',array('class' => 'input-md col-md-2 control-label') ) !!}
							<span class="control-label col-md-10">New ID</span>
							{!!	Form::radio('email', 'Delete ID',$form->email=='Delete ID',array('class' => 'input-md col-md-2 control-label') ) !!}
							<span class="control-label col-md-10">Delete ID</span>
							{!!	Form::radio('email', 'Change Password',$form->email=='Change Password',array('class' => 'input-md col-md-2 control-label') ) !!}
							<span class="control-label col-md-10">Change Password</span>							
						</div>				
				</div>	
		

		
		
		
		
		
	<hr  />					
				<div class="form-group">
						<label  class="control-label col-md-3  requiredField"><span class="fa fa-commenting-o text-primary"></span> Notes: </label>
						<div class="controls col-md-9 col-md-pull-1" >
							{!!	Form::textarea('notes',$form->email,array('size'=>'70x3', 'class' => 'form-control','maxlength'=>100,'required','readonly') ) !!}						
						</div>		
			
				</div>		
	<hr  />	

  				<div class="form-group remarks" style="margin-bottom:50px;display:none">
						<label  class="control-label col-md-3 requiredField"><span class="fa fa-commenting-o text-primary"></span> Remarks: </label>
						<div style="margin-bottom:50px" class="controls col-md-9 col-md-pull-1" >
							{!!	Form::textarea('rem',"",array('size'=>'70x3','id'=>'rem', 'class' => 'form-control','maxlength'=>191,'required') ) !!}						
						</div>		
			
				</div>

	
</div>
</div>

  <div class="col-md-12">

	
   				<div class="form-group required">
	
  <button type="button" id="approve" class="btn btn-lg btn-success controls col-md-4 col-md-push-2">
    <span class="glyphicon glyphicon-ok"></span> Approve
  </button>						
  <button type="button" id="cancel" class="btn btn-lg btn-danger controls col-md-4 col-md-push-3">
    <span class="glyphicon glyphicon-remove"></span> Dismiss
  </button>
						
				</div>	
				
  </div>
  <hr />
  <br>
  <br>
 <div class="col-md-12">
			<div class="page-header">
			
			 <h3 class="text-info text-center"></h3>
            </div> 
 </div>
   <hr />
   <hr />
   		{!! Form::close() !!}
 </div>

@endsection