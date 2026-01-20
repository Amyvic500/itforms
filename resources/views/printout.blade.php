<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'IT_FORMS') }}</title>

	<link href="{{asset('dist/css/bootstrap-dialog.min.css')}}" rel="stylesheet">	
	<link href="{{asset('/bootstrap/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="print" href="{{asset('/vendor/bootstrap/css/print.css')}}"> 
    <!-- MetisMenu CSS -->
    <link href="{{asset('/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('/dist/css/sb-admin-2.css')}}" rel="stylesheet">
	<link href="{{asset('/dist/css/pagination.css')}}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{{asset('/vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 5mm;  /* this affects the margin in the printer settings */
		//border: 1px solid black;
    }

    body 
    {
        background-color:#FFFFFF; 
        border: none;
        margin: 10px;  /* this affects the margin on the content before sending to printer */
   }

  .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
	border: 2px solid #0c0b0b;
} 
</style>
</head>
<body>
<table class="table table-bordered table-sm table-center">
<thead>
<tr>
<th colspan="4" class="text-center h2">@php 
if($form->comp=="ESRNL"){
	echo "EKO SUPREME RESOURCES NIGERIA LIMITED 1004";
}
elseif($form->comp=="NPRNL"){
	echo "EKO SUPREME RESOURCES NIGERIA LIMITED 1005";
}
elseif($form->comp=="PFNL"){
	echo "PRIMERA FOOD NIGERIA LIMITED";
}
@endphp</th>
</tr>
<tr>
<th colspan="4" class="text-center h3">IT REQUEST FORM</th>
</tr>
<tr>
<th colspan="4" class="text-center h4"><i class="fa fa-user-circle-o fa-1x"></i><b> USER INFORMATION</b></th>
</tr>
</thead>
<tbody>
<tr><td class="text-left h4"><span class="fa fa-vcard-o text-primary"></span> First Name<span class="asteriskField">*</span></td><td class="text-left h4">{{$form->fName}}</td><td class="text-left h4"><span class="fa fa-vcard text-primary"></span>  Last Name<span class="asteriskField">*</span></td><td class="text-left h4">{{ $form->lName }}</td></tr>
<tr><td class="text-left h4"><span class="fa fa-bank text-primary"></span> Company<span class="asteriskField">*</span></td><td class="text-left h4">{{$form->comp}}</td><td class="text-left h4"><span class="fa fa-street-view text-primary"></span> Location<span class="asteriskField">*</span></td><td class="text-left h4">{{ $form->loc }}</td></tr>
<tr><td class="text-left h4"><span class="fa fa-group text-primary"></span> Department<span class="asteriskField">*</span></td><td class="text-left h4">{{$form->dept}}</td><td class="text-left h4"><span class="fa fa-toggle-on text-primary"></span> Position<span class="asteriskField">*</span></td><td class="text-left h4">{{ $form->post }}</td></tr>

<tr><td class="text-left h4"><span class="fa fa-unsorted text-primary"></span> Status<span class="asteriskField">*</span></td><td class="text-left h4">{{$form->status}}</td><td class="text-left h4"><span class="fa fa-plus-circle text-primary"></span> current<span class="asteriskField">*</span></td><td class="text-left h4">{{ $form->curr }}</td></tr>
<tr>
<th colspan="4" class="text-center h3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
<tr>
<th colspan="4" class="text-center h4"><i class="fa fa-language fa-1x"></i><b> REQUEST DETAILS</b></th>
</tr>
@if(($form->status=='APPLICATION') || ($form->status=='REPORT'))
<tr><td class="text-left h4"><span class="fa fa-desktop text-primary"></span> Selected Application : </td><td class="text-left h4" colspan="3">		
	{{ $form->selApp  }}
	</td></tr>	
@if($form->status=='REPORT')
<tr><td class="text-left h4"><span class="fa fa-book text-primary"></span> Application Format : </td><td class="text-left h4" colspan="3">		
	{{ $form->repFormat }}
	</td></tr>	
	
	@endif
	
<tr><td class="text-left h4" colspan="4"></tr>	
@else
<tr><td class="text-left h4"><span class="fa fa-mail-reply text-primary"></span> SIR </td><td class="text-left h4">		
{{ $form->sir }} @if($form->sirtext)
	{{" : ".$form->sirtext}}
@endif
	</td><td class="text-left h4"><span class="fa fa-envelope-open-o text-primary"></span> Email </td><td class="text-left h4 ">{{ $form->email }}@if($form->emailtext)
	{{" : ".$form->emailtext}}
@endif</td></tr>
<tr><td class="text-left h4"><span class="fa fa-globe text-primary"></span> Internet </td><td class="text-left h4">		
{{$form->net}}@if($form->nettext)
	{{" : ".$form->nettext}}
@endif</td><td class="text-left h4"><span class="fa fa-desktop text-primary"></span> Remote&nbsp;&nbsp;</td><td class="text-left h4">{{$form->remote}} @if($form->remotetext)
	{{" : ".$form->remotetext}}
@endif</td></tr>	
<tr><td class="text-left h4"><span class="fa fa-braille text-primary"></span> E-Leave </td><td class="text-left h4">		
{{$form->eLeave}}  @if($form->eleavetext)
	{{" : ".$form->eleavetext }}
@endif</td><td class="text-left h4"><span class="fa fa-cubes text-primary"></span> SAP </td><td class="text-left h4">{{$form->sap}}  @if($form->saptext)
	{{" : ".$form->saptext}}
@endif</td></tr>	
<tr><td class="text-left h4"><span class="fa fa-clock-o text-primary"></span> Ingress </td><td class="text-left h4">		
{{$form->ingress}} @if($form->ingresstext)
	{{" : ".$form->ingresstext}}
@endif	</td><td class="text-left h4"><span class="fa fa-comments text-primary"></span> Spark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="text-left h4">{{$form->spark}} @if($form->sparktext)
	{{" : ".$form->sparktext}}
@endif</td></tr>	
@endif
<tr>
<td class="text-left h4"><span class="fa fa-commenting-o text-primary"></span> Notes:  </td><td colspan="3" class="text-left h4">		
{{$form->notes}}</td>
</tr>
@if(!empty($form->remarks))
<tr>
<td class="text-left h4"><span class="fa fa-commenting-o text-primary"></span> Remarks:  </td><td colspan="3" class="text-left h4">		
{{$form->remarks}}</td>
</tr>
@endif
<tr>
<th colspan="4" class="text-center h3"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
<tr>
<td colspan="2">HOD Sign/Date:<br><br><br><u>
@if($form->apprStatus>9)
	APPROVED {{ $form->eApp4 }}
@elseif($form->apprStatus<9)
	 {{ $form->eApp4 }}
	@endif
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td><td colspan="2">User Sign/Date:<br><br><br><u>
{{ $form->eApp3.'  '.'   '.date('m/d/y h:m:sA', strtotime($form->created_at)) }}
</u></td></tr>	
<tr><td colspan="2">IT HOD Sign/Date:<br><br><br><u>
@if($form->apprStatus>29)
	APPROVED {{ $form->eApp5 }}
@elseif($form->apprStatus<29)
	 {{ $form->eApp5 }}
	@endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td><td colspan="2">IT Admin Sign/Date:<br><br><br><u>
@if(($form->apprStatus==40)|| ($form->approval=='COMPLETED'))
{{'COMPLETED'.'  '.'  '.date('m/d/y h:m:sA', strtotime($form->updated_at)) }}
@else
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

@endif	</u></td></tr>			
</tbody>
</table>
 
    <!-- jQuery -->
    <script src="{{asset('/bootstrap/js/jquery-2.2.4.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <script src="{{asset('/dist/js/sb-admin-2.blade.php.js')}}"></script>
	<script src="{{asset('/dist/js/pagination.js')}}"></script>
    <script src="{{asset('dist/js/bootstrap-dialog.min.js')}}"></script>
    <!-- Custom Theme JavaScript -->
</body>
 </html>