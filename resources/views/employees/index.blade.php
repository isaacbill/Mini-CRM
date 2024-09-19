@extends('layouts.app')

@section('title', 'Employees')
@section('content_header')
    <h1>Employees</h1>
@stop

@section('css')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <!-- Add Employee Button -->
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-success">Add Employee</a>
    </div>

    <!-- DataTable -->
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection

@section('js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'company.name', name: 'company.name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('.data-table').on('click', '.delete', function () {
            var url = $(this).data('url');
            
            if (confirm("Are you sure you want to delete this employee?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function (response) {
                        table.ajax.reload();
                        alert(response.success);
                    },
                    error: function (xhr) {
                        alert('Something went wrong while deleting!');
                    }
                });
            }
        });
    });
    </script>
@stop
