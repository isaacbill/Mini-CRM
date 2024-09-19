@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<div class="container">
    <h2>Edit Employee</h2>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
        </div>
        <div class="form-group">
            <label for="company_id">Company:</label>
            <select id="company_id" name="company_id" class="form-control" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $employee->email }}">
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $employee->phone }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
