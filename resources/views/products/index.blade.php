@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">View Products</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Products</li>
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
                    <h4 class="card-title">Products</h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary float-right">Create Product</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table" id="product-table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Branch</th>
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
    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("products.list") }}', // Your data fetching route
        columns: [
            { data: 'product_name', name: 'product_name' },
            { data: 'sku', name: 'sku' },
            { data: 'price', name: 'price' },
            { data: 'category', name: 'category' },
            { data: 'branch', name: 'branch' }, // Assuming branch relation exists
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        pageLength: 10, // Define number of records per page
        lengthMenu: [5, 10, 25, 50], // Allow users to change pagination size
    });

    $(document).on('click', '.delete-product', function() {
        const productId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This product will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/products") }}/' + productId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Product deleted successfully!');
                            $('#product-table').DataTable().ajax.reload();
                        } else {
                            toastr.error('Failed to delete product.');
                        }
                    },
                    error: function() {
                        toastr.error('Error occurred while deleting product.');
                    }
                });
            }
        });
    });
});
</script>
@endsection
