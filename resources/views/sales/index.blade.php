@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">Sales Management</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Sales</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section id="sales-list">
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Records</h4>
                    {{-- <a href="{{ route('sales.create') }}" class="btn btn-primary float-right">Add Sale</a> --}}
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table" id="sales-table">
                            <thead>
                                <tr>
                                    <th>Sale ID</th>
                                    <th>User</th>
                                    <th>Branch</th>
                                    <th>Total Amount</th>
                                    <th>Sale Date</th>
                                    @can('view reports')
                                    <th>Actions</th>
                                    @endcan
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
$(document).ready(function() {
    $('#sales-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("sales.list") }}', // Adjust this route accordingly
    columns: [
        { data: 'sale_id', name: 'sale_id' },
        { data: 'username', name: 'user.username' }, // Assuming user relationship exists
        { data: 'branch_name', name: 'branch.branch_name' }, // Assuming branch relationship exists
        { data: 'total_amount', name: 'total_amount' },
        { data: 'sale_date', name: 'sale_date' },
        @can('view reports')
            { data: 'action', name: 'action', orderable: false, searchable: false },
            @endcan
    ],
    pageLength: 10,
    lengthMenu: [5, 10, 25, 50],
});

    // Handle delete action if necessary
    $(document).on('click', '.delete-sale', function() {
        const saleId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This sale record will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/sales") }}/' + saleId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Sale record deleted successfully!');
                            $('#sales-table').DataTable().ajax.reload();
                        } else {
                            toastr.error('Failed to delete sale record.');
                        }
                    },
                    error: function() {
                        toastr.error('Error occurred while deleting sale record.');
                    }
                });
            }
        });
    });
});
</script>
@endsection
