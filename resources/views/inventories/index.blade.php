@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">Inventory Management</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Inventory</li>
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
                    <h4 class="card-title">Inventory</h4>
                    <a href="{{ route('inventory.create') }}" class="btn btn-primary float-right">Add Inventory</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table" id="inventory-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Branch</th>
                                    <th>Quantity</th>
                                    <th>Minimum Quantity</th>
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
    $('#inventory-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("inventory.list") }}',
        columns: [
            { data: 'product', name: 'product' },
            { data: 'branch', name: 'branch' },
            { data: 'quantity', name: 'quantity' },
            { data: 'min_quantity', name: 'min_quantity' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
    });

    $(document).on('click', '.delete-inventory', function() {
        const inventoryId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This inventory record will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/inventory") }}/' + inventoryId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Inventory record deleted successfully!');
                            $('#inventory-table').DataTable().ajax.reload();
                        } else {
                            toastr.error('Failed to delete inventory record.');
                        }
                    },
                    error: function() {
                        toastr.error('Error occurred while deleting inventory record.');
                    }
                });
            }
        });
    });
});
</script>
@endsection
