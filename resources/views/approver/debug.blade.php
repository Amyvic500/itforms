@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Approver Lookup Debugger</h2>
    
    <div class="card mb-4">
        <div class="card-header">Test Approver Lookup</div>
        <div class="card-body">
            <form method="GET" action="{{ url('approver/debug') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Department</label>
                            <input type="text" name="dept" class="form-control" 
                                   value="{{ old('dept', $searchDept ?? '') }}" 
                                   placeholder="IT" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="company" class="form-control" 
                                   value="{{ old('company', $searchCompany ?? '') }}" 
                                   placeholder="EIL" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Location (Optional)</label>
                            <input type="text" name="location" class="form-control" 
                                   value="{{ old('location', $searchLocation ?? '') }}" 
                                   placeholder="Lagos">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Check Approvers</button>
            </form>
        </div>
    </div>

    @if(isset($matchedApprovers))
    <div class="card mb-4">
        <div class="card-header">
            Lookup Results for: 
            <strong>{{ $searchDept }}</strong> / 
            <strong>{{ $searchCompany }}</strong>
            @if($searchLocation) / <strong>{{ $searchLocation }}</strong>@endif
        </div>
        <div class="card-body">
            @if($matchedApprovers->count())
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matchedApprovers as $approver)
                        <tr>
                            <td>{{ $approver->name }}</td>
                            <td>{{ $approver->email }}</td>
                            <td>{{ $approver->dept }}</td>
                            <td>{{ $approver->company }}</td>
                            <td>{{ $approver->location ?? 'Any' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">No approvers found matching these criteria!</div>
            @endif
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-header">All Approvers in System ({{ $allApprovers->count() }})</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Company</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allApprovers as $approver)
                    <tr>
                        <td>{{ $approver->name }}</td>
                        <td>{{ $approver->email }}</td>
                        <td>{{ $approver->dept }}</td>
                        <td>{{ $approver->company }}</td>
                        <td>{{ $approver->location ?? 'Any' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $allApprovers->links() }}
        </div>
    </div>
</div>
@endsection