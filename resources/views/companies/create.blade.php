@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Company') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   pattern=".*@co\.ke|.*@go\.ke" 
                                   placeholder="e.g. example@co.ke">
                            <small class="form-text text-muted">Email should be in the format example@co.ke or example@go.ke</small>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            <small class="form-text text-muted">Upload a logo image (optional)</small>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" id="website" name="website" 
                                   pattern="https://www\..*" 
                                   placeholder="e.g. https://www.example.com">
                            <small class="form-text text-muted">Website URL should start with https://www.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Company</button>
                        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.table').DataTable();
});
</script>
@endsection
