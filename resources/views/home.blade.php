@extends('layouts.app1')

@section('content')
<div class="row">
 <div class="col-sm-12 col-md-12">
			<div class="page-header">
			@if (session('status'))
				<div class="alert alert-{{ session('alert')}} h4 text-center">
					{{ session('status') }}
				</div>
			@endif			
			 <h3 class="text-info text-center"><i class="fa fa-user-circle-o fa-1x"></i> User Information</h3>
            </div> 
 </div>
 <div class="col-sm-12 col-md-12">
 {{ Form::open(['action' => array('ReqController@store'),'id'=>'reqstore', 'files'=>true, 'enctype'=>"multipart/form-data"]) }}
	<div class="form-horizontal">
 				<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-vcard-o text-primary"></span> First Name<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('firstName',"",array('class' => 'input-md form-control', 'required')) }} 
						</div>		
	
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-vcard text-primary"></span>  Last Name<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('lastName',"",array('class' => 'input-md form-control', 'required')) }} 
						</div>				
				</div>		
		
 				<div id="div_id_select" class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-bank text-primary"></span> Company<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::select('company',config('app.company'),"",array('class' => 'form-control', 'required', 'id'=>'company')) }} 
						</div>				

						<label  class="control-label col-md-2  requiredField"><span class="fa fa-street-view text-primary"></span> Location<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						
						{{ Form::select('location',[""=>"","APAPA"=>"APAPA","FACTORY"=>"FACTORY", "HEAD OFFICE"=>"HEAD OFFICE"],"",array('class' => 'input-md form-control','id'=>'location', 'required')) }} 
						
						</div>	
						
				</div>
 				<div class="form-group required">

						<label  class="control-label col-md-2  requiredField"><span class="fa fa-group text-primary"></span> Department<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::select('dept',config('app.department'),"",array('class' => 'input-md form-control', 'id'=>'department')) }} 
						</div>	
						
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-toggle-on text-primary"></span> Designation<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::text('position',"",array('class' => 'input-md form-control', 'required')) }} 
						</div>		
				</div>	
 				<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-unsorted text-primary"></span> Category<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::select('status',config('app.category'),"",array('class' => 'input-md form-control','id'=>'status', 'required')) }} 
						</div>		
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-plus-circle text-primary"></span> Purpose<span class="asteriskField">*</span></label>
						<div class="controls col-md-4" >
						{{ Form::select('req',[""=>"","Create new User"=>"Create new  User","Replace existing User"=>"Replace existing User", "Additional User"=>"Additional User","Additional Authorization"=>"Additional Authorization"],"",array('class' => 'input-md form-control', 'id'=>'purpose', 'required')) }} 
						</div>						
				</div>		
							<div class="form-group required" id="existed" hidden>
								<div class="col-md-12 col-md-push-6">
								<label  class="control-label col-md-2  requiredField"><span class="fa fa-user-o text-primary"> </span> Existing User<span class="asteriskField">*</span></label>
								<div class="controls col-md-4" >
								{{ Form::text('existed',"",array('class' => 'input-md form-control', )) }} 
								</div>		
								</div>
						</div>
 				<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-male text-primary"></span> HOD Email<span class="asteriskField">*</span></label>
						<div class="controls col-md-10">
						{{ Form::text('hodemail',"",array('class' => 'input-md form-control text-center', 'id'=>'hodemail', 'readonly')) }} 
						</div>		
					
				</div>

						<div class="form-group required reports" id="repformat" hidden>
								<div class="col-md-12 col-md-push-6">
								<label  class="control-label col-md-2  requiredField"><span class="fa fa-area-chart text-primary"> </span>  Report Format<span class="asteriskField">*</span></label>
								<div class="controls col-md-4"> 
								{{ Form::select('repFormat',["DOC"=>"DOC","XLS"=>"XLS","PDF"=>"PDF"],"",array('class' => 'input-md form-control', 'id'=>'purpose', 'required')) }} 
								</div>		
								</div>
						</div>				
			 			<div class="form-group required">
						<label  class="control-label col-md-2  requiredField"><span class="fa fa-address-book-o text-primary"></span> User Email <span class="asteriskField">*</span></label>
						<div class="controls col-md-5" >
						{{ Form::email('userEmail',"",array('class' => 'input-md form-control','id'=>'userEmail', 'required')) }} 
						</div>		
						<label  class="control-label col-md-3  requiredField"><span class="fa fa-phone text-primary"></span> Office Extension <span class="asteriskField">*</span></label>
						<div class="controls col-md-2" >
						{{ Form::text('extNum',"",array('class' => 'input-md form-control', 'id'=>'extNum','onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57' ,'required')) }} 
						</div>						
				</div>		
</div>				
 </div>
  <div class="col-sm-12 col-md-12">
			<div class="page-header">
			
			 <h3 class="text-info text-center"><i class="fa fa-language fa-1x"></i> Request Details</h3>
            </div> 
 </div>
  <div class="col-sm-12 col-md-12">
  	<div class="userreport" hidden>

				 		<div class="form-group required">
						<label  class="control-label col-md-4  requiredField"><span class="fa fa-braille text-primary"></span> Select Application<span class="asteriskField">*</span></label>
						<div class="controls col-md-6" >
{{ Form::select('selApp',["SAP"=>"SAP","INGRESS"=>"INGRESS","E-WAYBILL"=>"E-WAYBILL","E-QCPASS"=>"E-QCPASS"],"",array('class' => 'input-md form-control')) }} 
						</div>					
						</div>	
						<br>
						<br>
						<br>
						<br>						
				 		<div class="form-group required">
						<label  class="control-label col-md-4  requiredField"><span class="fa fa-folder-open-o text-primary"></span>Attach Template</label>
						<div class="controls col-md-6" >
					{{ Form::file('selFile',array('class' => 'input-md form-control-file')) }} 
						</div>					
						</div>							
	
	    <hr>
		<br>
		<br>
	</div>  <!-- end of user report -->
	
  	<div class="appreport" hidden>

				 		<div class="form-group required">
						<label  class="control-label col-md-4  requiredField"><span class="fa fa-braille text-primary"></span> Application Name/Purpose<span class="asteriskField">*</span></label>
						<div class="controls col-md-6" >
						{{ Form::text('selApp1',"",array('class' => 'input-md form-control')) }} 
						</div>					
						</div>	
						<br>
						<br>
						<br>
						<br>						
				 		<div class="form-group required">
						<label  class="control-label col-md-4  requiredField"><span class="fa fa-folder-open-o text-primary"></span>Attach Application Description</label>
						<div class="controls col-md-6" >
						{{ Form::file('selFile1',array('class' => 'input-md form-control-file')) }} 
						</div>					
						</div>							
	
	    <hr>
		<br>
		<br>
	</div>  <!-- end of application  report -->
	
	
<div class="form-inline">

	<div class="userinput">
				<div class="form-group">
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-sm-6 col-md-6  requiredField"><span class="fa fa-mail-reply text-primary"></span> Athena </label>
						<div class="controls col-sm-6 col-sm-pull-1 col-md-6 col-md-pull-1">
							{{	Form::radio('sir', 'New ID', false,array('class' => 'input-md col-sm-2 col-md-2 control-label sir') ) }}
							<span class="control-label col-sm-10 col-md-10 text-left">New ID</span>
							{{	Form::radio('sir', 'Delete ID', false,array('class' => 'input-md col-sm-2 col-md-2 control-label sir') ) }}
							<span class="control-label col-sm-10 col-md-10">Delete ID</span>
							{{ Form::text('sirdelete',"",array('class' => 'input-md form-control', 'id'=>'sirdelete', 'style'=>'display:none')) }} 						
							{{	Form::radio('sir', 'Reset Password', false,array('class' => 'input-md col-sm-2 col-md-2 control-label   sir') ) }}
							<span class="control-label col-sm-10 col-md-10">Reset Password</span>
							{{ Form::text('sirreset',"",array('class' => 'input-md form-control', 'id'=>'sirreset', 'style'=>'display:none')) }} 
{{	Form::radio('sir', 'Existing ID', false,array('class' => 'input-md col-sm-2 col-md-2 control-label authorClass') ) }}							
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>
							{{ Form::text('sirexisting',"",array('class' => 'input-md form-control', 'id'=>'sirexisting', 'style'=>'display:none')) }} 
						</div>	
				</div>						
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-sm-6 col-md-6  requiredField"><span class="fa fa-envelope-open-o text-primary"></span> Email </label>
						<div class="controls col-sm-6 col-sm-pull-1 col-md-6 col-md-pull-1">
							{{	Form::radio('email', 'New ID', false,array('class' => 'input-md col-sm-2 col-md-2 control-label email') ) }}
							<span class="control-label col-sm-10 col-md-10">New ID</span>
							{{	Form::radio('email', 'Delete ID', false,array('class' => 'input-md col-sm-2 col-md-2 control-label email') ) }}
							<span class="control-label col-sm-10 col-md-10">Delete ID</span>
							{{ Form::text('emaildelete',"",array('class' => 'input-md form-control', 'id'=>'emaildelete', 'style'=>'display:none')) }} 	
							{{	Form::radio('email', 'Reset Password', false,array('class' => 'input-md col-md-2 control-label email') ) }}
							<span class="control-label col-sm-10 col-md-10">Reset Password</span>	
							{{ Form::text('emailreset',"",array('class' => 'input-md form-control', 'id'=>'emailreset', 'style'=>'display:none')) 	}} 			
							{{	Form::radio('email', 'Existing ID', false,array('class' => 'input-md col-sm-2 col-md-2 control-label authorClass') ) }}
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>
							{{ Form::text('emailexisting',"",array('class' => 'input-md form-control', 'id'=>'emailexisting', 'style'=>'display:none')) }} 								
						</div>				
				</div>		
				</div>
<hr />
				<div class="form-group">
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-globe text-primary"></span>Internet&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('net', 'New ID', false,array('class' => 'input-md col-md-2 control-label net') ) }}
							<span class="control-label col-sm-10 col-md-10 text-left">New ID</span>
							{{	Form::radio('net', 'Delete ID', false,array('class' => 'input-md col-md-2 control-label net') ) }}
							<span class="control-label col-sm-10 col-md-10">Delete ID</span>
							{{ Form::text('netdelete',"",array('class' => 'input-md form-control', 'id'=>'netdelete', 'style'=>'display:none')) }} 
							{{	Form::radio('net', 'Reset Password', false,array('class' => 'input-md col-md-2 control-label net') ) }}
							<span class="control-label col-sm-10 col-md-10">Reset Password</span>	
							{{ Form::text('netreset',"",array('class' => 'input-md form-control', 'id'=>'netreset', 'style'=>'display:none')) 	}} 
							{{	Form::radio('net', 'Existing ID', false,array('class' => 'input-md col-md-2 control-label authorClass') ) }}
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>	
							{{ Form::text('netexisting',"",array('class' => 'input-md form-control', 'id'=>'netexisting', 'style'=>'display:none')) 	}} 
						</div>		
				</div>
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-desktop text-primary"></span>Remote&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('rem', 'New ID', false,array('class' => 'input-md col-md-2 control-label rem') ) }}
							<span class="control-label col-sm-10 col-md-10">New ID</span>
							{{	Form::radio('rem', 'Delete ID', false,array('class' => 'input-md col-md-2 control-label rem') ) }}
							<span class="control-label col-sm-10 col-md-10">Delete ID</span>
							{{ Form::text('remdelete',"",array('class' => 'input-md form-control', 'id'=>'remdelete', 'style'=>'display:none')) }} 
							{{	Form::radio('rem', 'Reset Password', false,array('class' => 'input-md col-md-2 control-label rem') ) }}
							<span class="control-label col-sm-10 col-md-10">Reset Password</span>	
							{{ Form::text('remreset',"",array('class' => 'input-md form-control', 'id'=>'remreset', 'style'=>'display:none')) }} 
							{{	Form::radio('rem', 'Existing ID', false,array('class' => 'input-md col-md-2 control-label authorClass') ) }}
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>	
							{{ Form::text('remexisting',"",array('class' => 'input-md form-control', 'id'=>'remexisting', 'style'=>'display:none')) }} 
						</div>				
				</div>	
				</div>				
	<hr  />	
				<div class="form-group">
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-braille text-primary"></span>  E-Leave </label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('eleave', 'New ID', false,array('class' => 'input-md col-md-2 control-label hrms') ) }}
							<span class="control-label col-sm-10 col-md-10 text-left">New ID</span>
							{{	Form::radio('eleave', 'Delete ID', false,array('class' => 'input-md col-md-2 control-label eleave') ) }}
							<span class="control-label col-sm-10 col-md-10">Delete ID</span>
							{{ Form::text('eleavedelete',"",array('class' => 'input-md form-control', 'id'=>'eleavedelete', 'style'=>'display:none')) }} 
							{{	Form::radio('eleave', 'Reset Password', false,array('class' => 'input-md col-md-2 control-label eleave') ) }}
							<span class="control-label col-sm-10 col-md-10">Reset Password</span>
							{{ Form::text('eleavereset',"",array('class' => 'input-md form-control', 'id'=>'eleavereset', 'style'=>'display:none')) }} 
							{{	Form::radio('eleave', 'Existing ID', false,array('class' => 'input-md col-md-2 control-label authorClass') ) }}
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>
							{{ Form::text('eleaveexisting',"",array('class' => 'input-md form-control', 'id'=>'eleaveexisting', 'style'=>'display:none')) }} 
						</div>		
				</div>
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-cubes text-primary"></span> SAP </label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('sap', 'New ID', false,array('class' => 'input-md col-md-2 control-label sap') ) }}
							<span class="control-label col-sm-10 col-md-10">New ID</span>
							{{	Form::radio('sap', 'Delete ID', false,array('class' => 'input-md col-md-2 control-label sap') ) }}
							<span class="control-label col-sm-10 col-md-10">Delete ID</span>
							{{ Form::text('sapdelete',"",array('class' => 'input-md form-control', 'id'=>'sapdelete', 'style'=>'display:none')) }} 
							{{	Form::radio('sap', 'Reset Password', false,array('class' => 'input-md col-md-2 control-label sap') ) }}
							<span class="control-label col-sm-10 col-md-10">Reset Password</span>	
							{{ Form::text('sapreset',"",array('class' => 'input-md form-control', 'id'=>'sapreset', 'style'=>'display:none')) }} 
							{{	Form::radio('sap', 'Existing ID', false,array('class' => 'input-md col-md-2 control-label authorClass') ) }}
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>	
							{{ Form::text('sapexisting',"",array('class' => 'input-md form-control', 'id'=>'sapexisting', 'style'=>'display:none')) }} 
						</div>	
				</div>
				</div>	
	<hr  />					
				<div class="form-group">
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-clock-o text-primary"></span>&nbsp;&nbsp;Ingress&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('ingress', 'New ID', false,array('class' => 'input-md col-md-2 control-label usern ingress') ) }}
							<span class="control-label col-sm-10 col-md-10 text-left usern">New ID</span>
							{{	Form::radio('ingress', 'Delete ID', false,array('class' => 'input-md col-md-2 control-label userd ingress') ) }}
							<span class="control-label col-sm-10 col-md-10 userd">Delete ID</span>
							{{ Form::text('ingressdelete',"",array('class' => 'input-md form-control', 'id'=>'ingressdelete', 'style'=>'display:none')) }} 
							{{	Form::radio('ingress', 'Reset Password', false,array('class' => 'input-md col-md-2 control-label userc ingress') ) }}
							<span class="control-label col-sm-10 col-md-10 userc">Reset Password</span>
							{{ Form::text('ingressreset',"",array('class' => 'input-md form-control', 'id'=>'ingressreset', 'style'=>'display:none')) }} 
							{{	Form::radio('ingress', 'Existing ID', false,array('class' => 'input-md col-md-2 control-label authorClass') ) }}
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>
							{{ Form::text('ingressexisting',"",array('class' => 'input-md form-control', 'id'=>'ingressexisting', 'style'=>'display:none')) }} 							
						</div>		
				</div>
				<div class="col-sm-6 col-md-6">
						<label  class="control-label col-md-6  requiredField"><span class="fa fa-comments text-primary"></span>&nbsp;&nbsp;Spark&nbsp;&nbsp;&nbsp;</label>
						<div class="controls col-md-6 col-md-pull-1" >
							{{	Form::radio('spark', 'New ID', false,array('class' => 'input-md col-md-2 control-label spark') ) }}
							<span class="control-label col-sm-10 col-md-10">New ID</span>
							{{	Form::radio('spark', 'Delete ID', false,array('class' => 'input-md col-md-2 control-label spark') ) }}
							<span class="control-label col-sm-10 col-md-10">Delete ID</span>
							{{ Form::text('sparkdelete',"",array('class' => 'input-md form-control', 'id'=>'sparkdelete', 'style'=>'display:none')) }} 
							{{	Form::radio('spark', 'Reset Password', false,array('class' => 'input-md col-md-2 control-label spark') ) }}
							<span class="control-label col-sm-10 col-md-10">Reset Password</span>	
							{{ Form::text('sparkreset',"",array('class' => 'input-md form-control', 'id'=>'sparkreset', 'style'=>'display:none')) }}
							{{	Form::radio('spark', 'Existing ID', false,array('class' => 'input-md col-md-2 control-label authorClass') ) }}
							<span class="control-label col-sm-10 col-md-10 authorClass">Existing ID</span>	
							{{ Form::text('sparkexisting',"",array('class' => 'input-md form-control', 'id'=>'sparkexisting', 'style'=>'display:none')) }}							
						</div>		
				</div>						
				</div>	
				
			</div> <!-- end of user input div -->	
	<hr  />					
				<div class="form-group">
						<label  class="control-label col-md-3  requiredField"><span class="fa fa-commenting-o text-primary"></span> Notes: </label>
						<div class="controls col-md-9 col-md-pull-1" >
						<i class="internet h5" hidden>Please list internet sites in format - http://www.google.com </i>
							{{	Form::textarea('notes','',array('size'=>'100x3', 'class' => 'form-control','maxlength'=>100,'required', 'id'=>'notes') ) }}		
								<i class="reports h5" hidden>Please specify report purpose and format.</i>
						</div>		
			
				</div>		
	<hr  />	



	
</div>
</div>

  <div class="col-sm-12 col-md-12">
   				<div class="form-group required">
						<div class="controls col-md-4 col-md-push-4" >
						{{ Form::submit('Get Approval',array('class' => 'btn btn-lg btn-primary submt')) }} 
						</div>	
						<div class="controls col-md-4 col-md-push-4" >
						{{ Form::button('Clear Selection',array('class' => 'btn btn-lg btn-warning', 'id'=>'clearSel')) }} 
						</div>							
				</div>	
  </div>
  <hr />
  <br>
  <br>
 <div class="col-sm-12 col-md-12">
			<div class="page-header">
			
			 <h3 class="text-info text-center"></h3>
            </div> 
 </div>
   <hr />
   <hr />
   		{{ Form::close() }}
 </div>

@endsection