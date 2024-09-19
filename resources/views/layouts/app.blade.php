@extends('adminlte::page')

@section('title', 'CRM')

@section('content_header')
    <h1>{{ config('app.name', 'Laravel') }}</h1>
@stop

@section('content')
    @yield('main-content')
@stop

@section('css')
    <!-- Add here extra stylesheets -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/buttons.bootstrap4.min.css') }}">
    @stack('styles')
@stop

@section('js')
    <!-- AdminLTE JS -->
    <script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    @stack('scripts')
@stop
