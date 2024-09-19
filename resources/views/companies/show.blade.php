@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Company Details') }}</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $company->name }}</p>
                    <p><strong>Email:</strong> {{ $company->email }}</p>
                    <p><strong>Logo:</strong></p>
                    @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="img-fluid">
                    @endif
                    <p><strong>Website:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
                    <a href="{{ route('companies.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
