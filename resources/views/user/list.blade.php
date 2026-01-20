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
			 <h3 class="text-info text-center">Manage Users</h3>
            </div> 
 </div>
 <div class="col-md-12">
	<table class="table table-bordered table-stripped" id="dataTable">
	<thead>
	<tr>
	<th>S/N</th>
	<th>Name</th>
	<th>Email</th>
	<th>Admin</th>	
	<th>Edit</th>	
	<th>Delete</th>	
	</tr>
	
	</thead>
	<tbody>
	@if(count($users)>0)
		@foreach($users as $u)
			<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $u->name }}</td>
			<td>{{ $u->email}}</td>
			<td>@if($u->admin)
					YES
				@else
					NO
				@endif
			</td>
			<td> <a href="{{ route('user.edit', ['id'=>$u->id]) }}"><button class="btn btn-sm btn-info">Edit</button></a> </td>
			<td> <a href="{{ route('user.delete', ['id'=>$u->id]) }}"><button class="btn btn-sm btn-danger">Delete</button></a> </td>		
			</tr>	
		@endforeach
	@endif
	</tbody>
	</table>
	
	
 </div>		

</div>


@endsection