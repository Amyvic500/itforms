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
Dear {{ucfirst(explode(".", explode("@", $form->hod)[0])[0]) }},
<br>
<br>
A staff in {{ $form->dept }} department has requested {{ $form->selApp }} report with details below:
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
@foreach(explode(";",$form->curr) as $d)
{{ $d}}
@endforeach
</td>
</tr>
<tr><td colspan='4' style="text-align:center">Request Details </td>  </tr>
<tr><th>Application</th><td colspan='4'>
{{ $form->selApp}}
</td>
</tr>

<tr><th>Format</th><td colspan='4'>
{{ $form->repFormat }}
</td>
</tr>

<tr><th>Template</th><td colspan='4'>

</td>
</tr>
     
	 
	 
<tr><th>Notes:</th><td colspan='3' style="text-align:left">{{ $form->notes }}</td>
</tr>
</table>
<br>
<br>
Please click the link below to download attached template file. 
<a href="{{url('download?selFile='.$form->selFile)}}"> View Template </a>
<br>
<br>
<br>
IT Department
</body>
</html>