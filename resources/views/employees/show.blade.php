@extends('layouts.app')

@section('title', 'Show Employee')

@section('content')
<div class="container">
    <h2>Employee Details</h2>
    
    <table class="table table-bordered">
        <tr>
            <th>First Name:</th>
            <td>{{ $employee->first_name }}</td>
        </tr>
        <tr>
            <th>Last Name:</th>
            <td>{{ $employee->last_name }}</td>
        </tr>
        <tr>
            <th>Company:</th>
            <td>{{ $employee->company->name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $employee->email }}</td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td>{{ $employee->phone }}</td>
        </tr>
    </table>

    <a href="{{ route('employees.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
