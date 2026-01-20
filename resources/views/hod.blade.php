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
 @php 
  if(($form->apprStatus==30)||($form->apprStatus==28)){
	 
	 $hide = "none";
	 $read = "readonly";
 }
 else
 {
	$hide=""; 
	$read = "";
	$hide1 = "none";
	 
 }
 if($form->apprStatus==10){
 $rd = "readonly";	
 }
 else{ $rd="";}
 @endphp
 {{ Form::open(['action' => array('ReqController@store'),'method'=>'POST']) }}
	<div class="form-horizontal">
	<input value="{{ $form->id}}" id="formid" hidden/>
	<input value="{{ $email }}" id="email" hidden/>
 				<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-vcard-o text-primary"></span> First Name<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('firstName',$form->fName,array('class' => 'input-md form-control', 'readonly')) }} 
						</div>		
	
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-vcard text-primary"></span>  Last Name<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('lastName',$form->lName,array('class' => 'input-md form-control', 'readonly')) }} 
						</div>				
				</div>		
		
 				<div id="div_id_select" class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-bank text-primary"></span> Company<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{Form::text('location',$form->comp,array('class' => 'input-md form-control', 'readonly')) }}
						</div>				

						<label  class="control-label col-md-2  requiredField"><span class="fa fa-street-view text-primary"></span> Location<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('location',$form->loc,array('class' => 'input-md form-control','readonly')) }} 
						</div>	
						
				</div>
 				<div class="form-group required">

						<label  class="control-label col-md-2  requiredField"><span class="fa fa-group text-primary"></span> Department<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('dept',$form->dept,array('class' => 'input-md form-control', 'readonly')) }} 
						</div>	
						
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-toggle-on text-primary"></span> Position<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('position',$form->post,array('class' => 'input-md form-control', 'readonly')) }} 
						</div>		
					
				</div>	
 				<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-unsorted text-primary"></span> Status<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('status',$form->status,array('class' => 'input-md form-control', 'readonly')) }} 
						</div>		
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-plus-circle text-primary"></span> current<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('req',$form->curr,array('class' => 'input-md form-control', 'readonly')) }} 
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


	<div class="userinput">
				<div class="form-group">
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-mail-reply text-primary"></span> SIR </label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('sir', 'New ID', $form->sir=='New ID',array('class' => 'input-md col-md-2 control-label sir', 'disabled'=>1) ) }}
							<span class="control-label col-md-10 text-left">New ID</span>
							{{	Form::radio('sir', 'Delete ID', $form->sir=='Delete ID',array('class' => 'input-md col-md-2 control-label sir', 'disabled') ) }}
							<span class="control-label col-md-10">Delete ID</span>
							@if(($form->sirtext) && ($form->sir=='Delete ID'))
								{{ Form::text('sirdelete',$form->sirtext,array('class' => 'input-md form-control', 'id'=>'sirdelete', 'readonly')) }} 
							@endif
													
							{{	Form::radio('sir', 'Reset Password', $form->sir=='Reset Password',array('class' => 'input-md col-md-2 control-label   sir', 'disabled') ) }}
							<span class="control-label col-md-10">Reset Password</span>
							@if(($form->sirtext) && ($form->sir=='Reset Password'))
								{{ Form::text('sirreset',$form->sirtext,array('class' => 'input-md form-control', 'id'=>'sirreset', 'readonly')) }} 
							@endif
							
							
							@if($form->sir=='Existing ID')
							{{	Form::radio('sir', 'Existing ID',$form->sir=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled', 'checked'=>($form->sir=='Existing ID')) ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->sirtext)
							{{ Form::text('sirexisting',$form->sirtext,array('class' => 'input-md form-control', 'id'=>'sirexisting', 'readonly')) }}	
							@endif
							@endif
							
															
						</div>	
				</div>						
			
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-envelope-open-o text-primary"></span> Email </label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('email', 'New ID', $form->email=='New ID',array('class' => 'input-md col-md-2 control-label sir', 'disabled'=>1, 'checked'=>($form->email=='New ID')) ) }}
							<span class="control-label col-md-10">New ID</span>
							{{	Form::radio('email', 'Delete ID', $form->email=='Delete ID',array('class' => 'input-md col-md-2 control-label email', 'disabled', 'checked'=>($form->email=='Delete ID')) ) }}
							<span class="control-label col-md-10">Delete ID</span>
							@if(($form->emailtext) && ($form->email=='Delete ID'))
								{{ Form::text('emaildelete',$form->emailtext,array('class' => 'input-md form-control', 'id'=>'emaildelete', 'readonly')) }} 
							@endif
								
							{{	Form::radio('email','Reset Password',true,array('class' => 'input-md col-md-2 control-label email', 'disabled', 'checked'=>($form->email=='Reset Password')) ) }}
							<span class="control-label col-md-10">Reset Password</span>	
							@if(($form->emailtext) && ($form->email=='Reset Password'))
								{{ Form::text('emailreset',$form->emailtext,array('class' => 'input-md form-control', 'id'=>'emailreset', 'readonly')) 	}} 
							@endif
							

							@if($form->email=='Existing ID')
							{{	Form::radio('email', 'Existing ID',$form->email=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled', 'checked'=>($form->email=='Existing ID')) ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->emailtext)
							{{ Form::text('emailexisting',$form->emailtext,array('class' => 'input-md form-control', 'id'=>'emailexisting', 'readonly')) }}	
							@endif
							@endif
							
							
							
						</div>				
				</div>		
				</div>
<hr />
				<div class="form-group">
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-globe text-primary"></span>Internet&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('net', 'New ID', $form->net=='New ID',array('class' => 'input-md col-md-2 control-label net', 'disabled') ) }}
							<span class="control-label col-md-10 text-left">New ID</span>
							{{	Form::radio('net', 'Delete ID', $form->net=='Delete ID',array('class' => 'input-md col-md-2 control-label net', 'disabled') ) }}
							<span class="control-label col-md-10">Delete ID</span>
							@if(($form->nettext) && ($form->net=='Delete ID'))
								{{ Form::text('netdelete',$form->nettext,array('class' => 'input-md form-control', 'id'=>'netdelete', 'readonly')) }} 
							@endif
							
							{{	Form::radio('net', 'Reset Password', $form->net=='Reset Password',array('class' => 'input-md col-md-2 control-label net', 'disabled') ) }}
							<span class="control-label col-md-10">Reset Password</span>	
							@if(($form->nettext) && ($form->net=='Reset Password'))
								{{ Form::text('netreset',$form->nettext,array('class' => 'input-md form-control', 'id'=>'netreset', 'readonly')) 	}} 
							@endif
							
							
							@if($form->net=='Existing ID')
							{{	Form::radio('net', 'Existing ID',$form->net=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled', 'checked'=>($form->net=='Existing ID')) ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->nettext)
							{{ Form::text('netexisting',$form->nettext,array('class' => 'input-md form-control', 'id'=>'netexisting', 'readonly')) }}	
							@endif
							@endif
							
							
							
						</div>		
				</div>
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-desktop text-primary"></span>Remote&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('rem', 'New ID', $form->remote=='New ID',array('class' => 'input-md col-md-2 control-label rem', 'disabled') ) }}
							<span class="control-label col-md-10">New ID</span>
							{{	Form::radio('rem', 'Delete ID', $form->remote=='Delete ID',array('class' => 'input-md col-md-2 control-label rem', 'disabled') ) }}
							<span class="control-label col-md-10">Delete ID</span>
							@if(($form->remotetext) && ($form->remote=='Delete ID'))
								{{ Form::text('remdelete',$form->remotetext,array('class' => 'input-md form-control', 'id'=>'remdelete', 'readonly')) }} 
							@endif
							
							{{	Form::radio('rem', 'Reset Password', $form->net=='Reset Password',array('class' => 'input-md col-md-2 control-label rem', 'disabled') ) }}
							<span class="control-label col-md-10">Reset Password</span>
							@if(($form->remotetext) && ($form->remote=='Reset Password'))
								{{ Form::text('remreset',$form->remotetext,array('class' => 'input-md form-control', 'id'=>'remreset', 'readonly')) }} 
							@endif							
							
							
								
							@if($form->remote=='Existing ID')
							{{	Form::radio('remote', 'Existing ID',$form->remote=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled', 'checked'=>($form->remote=='Existing ID')) ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->remotetext)
							{{ Form::text('remoteexisting',$form->remotetext,array('class' => 'input-md form-control', 'id'=>'remoteexisting', 'readonly')) }}	
							@endif
							@endif
							
							
							
						</div>				
				</div>	
				</div>				
	<hr  />	
				<div class="form-group">
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-braille text-primary"></span> E-Leave </label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('eleave', 'New ID', $form->eLeave=='New ID',array('class' => 'input-md col-md-2 control-label eleave', 'disabled') ) }}
							<span class="control-label col-md-10 text-left">New ID</span>
							{{	Form::radio('eleave', 'Delete ID', $form->eLeave=='Delete ID',array('class' => 'input-md col-md-2 control-label eleave', 'disabled') ) }}
							<span class="control-label col-md-10">Delete ID</span>
								@if(($form->saptext) && ($form->sap=='Delete ID'))
								{{ Form::text('eleavedelete',$form->eleavetext,array('class' => 'input-md form-control', 'id'=>'eleavedelete', 'readonly')) }} 
							@endif
							
							{{	Form::radio('eleave', 'Reset Password', $form->eLeave=='Reset Password',array('class' => 'input-md col-md-2 control-label eleave', 'disabled') ) }}
							<span class="control-label col-md-10">Reset Password</span>
							@if(($form->eleavetext) && ($form->eLeave=='Reset Password'))
								{{ Form::text('eleavereset',$form->eleavetext,array('class' => 'input-md form-control', 'id'=>'eleavereset', 'readonly')) }} 
							@endif
							
							
							
								
							@if($form->eLeave=='Existing ID')
							{{	Form::radio('eleave', 'Existing ID',$form->eLeave=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled') ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->eleavetext)
							{{ Form::text('eLeaveexisting',$form->eleavetext,array('class' => 'input-md form-control', 'id'=>'eleaveexisting', 'readonly')) }}	
							@endif
							@endif
							
							
						</div>		
				</div>
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-cubes text-primary"></span> SAP &nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('sap', 'New ID', $form->sap=='New ID',array('class' => 'input-md col-md-2 control-label sap', 'disabled') ) }}
							<span class="control-label col-md-10">New ID</span>
							{{	Form::radio('sap', 'Delete ID', $form->sap=='Delete ID',array('class' => 'input-md col-md-2 control-label sap', 'disabled') ) }}
							<span class="control-label col-md-10">Delete ID</span>
							@if(($form->saptext) && ($form->sap=='Delete ID'))
								{{ Form::text('sapdelete',$form->saptext,array('class' => 'input-md form-control', 'id'=>'sapdelete', 'readonly')) }} 
							@endif
							
							{{	Form::radio('sap', 'Reset Password', $form->sap=='Reset Password',array('class' => 'input-md col-md-2 control-label sap', 'disabled') ) }}
							<span class="control-label col-md-10">Reset Password</span>				@if(($form->saptext) && ($form->sap=='Reset Password'))
								{{ Form::text('sapreset',$form->saptext,array('class' => 'input-md form-control', 'id'=>'sapreset', 'readonly')) }} 
							@endif
							
							
								
							@if($form->sap=='Existing ID')
							{{	Form::radio('sap', 'Existing ID',$form->sap=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled') ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->saptext)
							{{ Form::text('sapexisting',$form->saptext,array('class' => 'input-md form-control', 'id'=>'sapexisting', 'readonly')) }}	
							@endif
							@endif
							
							
						</div>	
				</div>
				</div>	
	<hr  />					
				<div class="form-group">
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-clock-o text-primary"></span>Ingress&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('ingress', 'New ID', $form->ingress=='New ID',array('class' => 'input-md col-md-2 control-label usern ingress', 'disabled') ) }}
							<span class="control-label col-md-10 text-left usern">New ID</span>
							{{	Form::radio('ingress', 'Delete ID', $form->ingress=='Delete ID',array('class' => 'input-md col-md-2 control-label userd ingress', 'disabled') ) }}
							<span class="control-label col-md-10 userd">Delete ID</span>
								@if(($form->ingresstext) && ($form->ingress=='Delete ID'))
								{{ Form::text('ingressdelete',$form->ingresstext,array('class' => 'input-md form-control', 'id'=>'ingressdelete', 'readonly')) }} 
							@endif
							
							{{	Form::radio('ingress','Reset Password',$form->ingress=='Reset Password
							',array('class' => 'input-md col-md-2 control-label userc ingress', 'disabled','checked'=>($form->ingress=='Reset Password')) ) }}
							<span class="control-label col-md-10 userc">Reset Password</span>
							@if(($form->ingresstext) && ($form->ingress=='Reset Password'))
								{{ Form::text('ingressreset',$form->ingresstext,array('class' => 'input-md form-control', 'id'=>'ingressreset', 'readonly')) }} 
							@endif
								
							@if($form->ingress=='Existing ID')
							{{	Form::radio('ingress', 'Existing ID',$form->ingress=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled') ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->sparktext)
							{{ Form::text('ingressexisting',$form->ingresstext,array('class' => 'input-md form-control', 'id'=>'ingressexisting', 'readonly')) }}	
							@endif
							@endif
						</div>		
				</div>
				<div class="col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-comments text-primary"></span>Spark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('spark', 'New ID', $form->spark=='New ID',array('class' => 'input-md col-md-2 control-label spark', 'disabled') ) }}
							<span class="control-label col-md-10">New ID</span>
							{{	Form::radio('spark', 'Delete ID', $form->spark=='Delete ID',array('class' => 'input-md col-md-2 control-label spark', 'disabled') ) }}
							<span class="control-label col-md-10">Delete ID</span>
							@if(($form->sparktext) && ($form->spark=='Delete ID'))
								{{ Form::text('sparkdelete',$form->sparktext,array('class' => 'input-md form-control', 'id'=>'sparkdelete', 'readonly')) }} 
							@endif
							
							{{	Form::radio('spark', 'Reset Password', $form->spark=='Reset Password',array('class' => 'input-md col-md-2 control-label spark', 'disabled') ) }}
							<span class="control-label col-md-10">Reset Password</span>	
							@if(($form->sparktext) && ($form->spark=='Reset Password'))
								{{ Form::text('sparkreset',$form->sparktext,array('class' => 'input-md form-control', 'id'=>'sparkreset', 'readonly')) }}
							@endif
							
							@if($form->spark=='Existing ID')
							{{	Form::radio('spark', 'Existing ID',$form->spark=='Existing ID',array('class' => 'input-md col-md-2 control-label','disabled','checked'=>($form->spark=='Existing ID')) ) }}
							<span class="control-label col-sm-10 col-md-10">Existing ID</span>	
							@if($form->sparktext)
							{{ Form::text('sparkexisting',$form->sparktext,array('class' => 'input-md form-control', 'id'=>'sparkexisting', 'readonly')) }}	
							@endif
							@endif
						</div>		
				</div>						
				</div>	
				
			</div> <!-- end of user input div -->	

@if($form->net=='New ID')
	
	<hr  />			
				<div class="form-group">
						<label  class="control-label col-md-3 requiredField"><span class="fa fa-code-fork text-primary"></span> Internet URL: </label>
						<div class="controls col-md-9 col-md-pull-1" >
							{{	Form::textarea('urlAdd',$form->eApp6,array('id'=>'urlAdd','size'=>'70x3', 'class' => 'form-control','maxlength'=>100,'required', 'readonly') ) }}		
								<i class="reports h4" hidden>Please specify report purpose and format.</i>
						</div>		
			
				</div>		
	<hr  />			
@endif	
	<hr  />					
				<div class="form-group">
						<label  class="control-label col-md-3  requiredField"><span class="fa fa-commenting-o text-primary"></span> Notes: </label>
						<div class="controls col-md-9 col-md-pull-1" >
							{{	Form::textarea('notes',$form->notes,array('size'=>'70x3', 'class' => 'form-control','maxlength'=>100,'required', 'readonly') ) }}		
								<i class="reports h4" hidden>Please specify report purpose and format.</i>
						</div>		
			
				</div>		
	<hr  />	
	
</div>
</div>

  <div class="col-md-12">
@if(($form->apprStatus==30)||($form->apprStatus==28))
	
@else
   				<div class="form-group required">
	
  <button type="button" id="happrove" class="btn btn-lg btn-success controls col-md-4 col-md-push-2">
    <span class="glyphicon glyphicon-ok"></span> Approve
  </button>						
  <button type="button" id="hcancel" class="btn btn-lg btn-danger controls col-md-4 col-md-push-3">
    <span class="glyphicon glyphicon-remove"></span> Dismiss
  </button>
						
				</div>	
@endif
				
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
   		{{ Form::close() }}
 </div>

@endsection