@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">View Branches</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Branch</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section id="dashboard-analytics">
    <div class="row mt-2 ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Branches</h4>
                    <a href="{{ route('branches.create') }}" class="btn btn-primary float-right">Create Branch</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table" id="branch-table">
                            <thead>
                                <tr>
                                    <th>Branch Name</th>
                                    <th>Location</th>
                                    <th>Contact Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <!-- SweetAlert and Toastr (For Success/Error Messages) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
$(document).ready(function() {
    $('#branch-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("branches.list") }}', // Use route for the data fetching
        columns: [
            { data: 'branch_name', name: 'branch_name' },
            { data: 'location', name: 'location' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        pageLength: 10, // Define number of records per page
        lengthMenu: [5, 10, 25, 50], // Allow users to change pagination size
    });

    // Handle Delete with SweetAlert Confirmation
    $(document).on('click', '.delete-branch', function() {
        const branchId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/branches") }}/' + branchId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Branch deleted successfully!');
                            $('#branch-table').DataTable().ajax.reload(); // Reload the DataTable
                        } else {
                            toastr.error('Failed to delete branch.');
                        }
                    },
                    error: function() {
                        toastr.error('Error occurred while deleting branch.');
                    }
                });
            }
        });
    });
});
</script>
@endsection
