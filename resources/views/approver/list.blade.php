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
			 <h3 class="text-info text-center"><i class="fa fa-user-circle-o fa-1x"></i> HOD Information List</h3>
            </div> 
 </div>
 <div class="col-md-12">
<table class="table table-responsive table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Department</th>	  
      <th scope="col">Company</th>
      <th scope="col">Location</th>	  
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>      
    </tr>
  </thead>
  <tbody>
    @foreach($app as $num=>$l)
    <tr>
      <th scope="row">{{ $loop->iteration}}</th>
      <td>{{ $l->name }}</td>
      <td>{{ $l->email }}</td>
      <td>{{ $l->dept }}</td>
      <td>{{$l->company}}</td>     
      <td>{{$l->location}}</td>
	   <td><a href="{{ route('approver.edit', $l->id) }}"><button class="btn btn-sm btn-info">Edit</button></a></td>
      <td>
        {!! Form::open(['action' => array('ApproverController@destroy', $l->id),'method'=>'DELETE']) !!}
        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
       {!! Form::close() !!}
      </td>       
    </tr>
    @endforeach
  </tbody>
</table> <!-- /table -->
{{ $app->links() }}
 </div>

@endsection