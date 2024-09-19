@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
<div class="container">
    <h2>Create Employee</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="company_id">Company:</label>
            <select id="company_id" name="company_id" class="form-control" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control"
                   pattern="[a-zA-Z0-9._%+-]+@(go\.ke|co\.ke|gmail\.com)$"
                   title="Email must be in the format of @go.ke, @co.ke, or @gmail.com">
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control"
                   pattern="\d*"
                   title="Phone number should only contain digits">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
