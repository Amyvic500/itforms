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
Dear Mr. {{ ucfirst(explode('.',$form->hod)[0]) }}
<br>
<br>
The below request has been created by IT, 
<br>
<br>
<br>
<table class="table1">
<tr><td colspan='4' style="text-align:center">User Information</td>  </tr>
<tr><th>First Name:</th><td>{{ $form->fName}}</td>
<th>Last Name:</th><td>{{ $form->lName }}</td></tr>
<tr><th>Company:</th><td>{{ $form->comp}}</td>
<th>Location:</th><td>{{ $form->loc }}</td></tr>
<tr><th>Department:</th><td>{{ $form->dept}}</td>
<th>Designation:</th><td>{{ $form->post }}</td></tr>
<tr><th>User Email:</th><td>{{ $form->userEmail}}</td>
<th>Office Extension:</th><td>{{ $form->extNum }}</td></tr>
<tr>
<th>Category:</th><td>{{ $form->status}}</td>
<th>Purpose:</th>
<td>
{{ $form->curr}}
</td>
</tr>
<tr><td colspan='4' style="text-align:center">Request Details </td>  </tr>
<tr><th>SIR:</th><td>
{{ $form->sir }}
@if($form->sirtext)
{{' - '.$form->sirtext}}
@endif	

</td>
<th>Email Address:</th><td>

{{ $form->email }}
@if($form->emailtext)
{{' - '.$form->emailtext}}
@endif	

</td></tr>

<tr><th>Internet:</th><td>

{{$form->net}}
@if($form->nettext)
{{' - '.$form->nettext}}
@endif	
</td>
<th>Remote App:</th><td>
{{ $form->remote }}
@if($form->remotetext)
{{' - '.$form->remotetext}}
@endif	
</td></tr>

<tr><th>E-Leave:</th><td>
{{ $form->eLeave }}
@if($form->eleavetext)
{{' - '.$form->eleavetext}}
@endif	
</td>
<th>SAP:</th><td>

{{ $form->sap }}
@if($form->saptext)
{{' - '.$form->saptext}}
@endif	

</td></tr>
<tr><th>Ingress:</th><td>
{{ $form->ingress }}
@if($form->ingresstext)
{{' - '.$form->ingresstext}}
@endif	
</td>
<th>Spark:</th><td>
{{$form->spark }}
@if($form->sparktext)
{{' - '.$form->sparktext}}
@endif	
</td></tr>
<tr><th>Notes:</th><td colspan='3' style="text-align:left">{{ $form->notes }}</td>
</tr>
</table>
<br>
<br>
Please inform requestor to contact IT for access details.
<br>
<br>
<br>
IT Department
</body>
</html>