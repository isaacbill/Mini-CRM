@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')
<div class="container">
    <h2>Edit Company</h2>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit company form -->
    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}">
        </div>

        <!-- Display the current logo if it exists -->
        @if($company->logo)
            <div class="form-group">
                <label>Current Logo</label><br>
                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" width="100"><br><br>
            </div>
        @endif

        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" class="form-control">
            <small class="form-text text-muted">Leave blank if you do not want to change the logo.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Company</button>
    </form>
</div>
@endsection
