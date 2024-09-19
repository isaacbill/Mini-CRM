@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies</h1>
@stop

@section('css')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <!-- Add Company Button -->
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('companies.create') }}" class="btn btn-success">Add Company</a>
    </div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop

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
            ajax: "{{ route('companies.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'website', name: 'website'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // Delete record with confirmation and AJAX
        $('.data-table').on('click', '.delete', function () {
            var url = $(this).data('url');
            
            if (confirm("Are you sure you want to delete this company?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function (response) {
                        table.ajax.reload(); // Reload the table
                        alert(response.success); // Show success message
                    },
                    error: function (xhr) {
                        alert('Something went wrong while deleting!'); // Error message
                    }
                });
            }
        });
    });
    </script>
@stop
