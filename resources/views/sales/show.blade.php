@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h3 class="content-header-title">Sale Details</h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sale ID: {{ $sale->id }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Branch:</strong> {{ $sale->branch->branch_name ?? 'Unknown Branch' }}</p>
                <p><strong>User:</strong> {{ $sale->user->first_name ?? 'Unknown User' }}</p>
                <p><strong>Sale Date:</strong> {{ $sale->sale_date }}</p>
                <p><strong>Total Amount:</strong> ${{ $sale->total_amount }}</p>
                
                <h5>Items</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Unknown Product' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->price }}</td>
                            <td>${{ $item->quantity * $item->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
