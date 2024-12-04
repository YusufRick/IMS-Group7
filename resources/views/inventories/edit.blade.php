@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">Edit Inventory</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Inventories</a></li>
                    <li class="breadcrumb-item active">Edit Inventory</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section id="dashboard-analytics">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Inventory</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('inventory.update', $inventory->inventory_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Branch Selection -->
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                @if (Auth::user()->branch_id) 
                                    <!-- Auth user has a branch_id -->
                                    <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}">
                                    <p class="form-control-plaintext">{{ Auth::user()->branch->branch_name }}</p>
                                @else
                                    <!-- Auth user has no branch_id -->
                                    <select name="branch_id" class="form-control" required>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->branch_id }}" {{ $inventory->branch_id == $branch->branch_id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <!-- Product Selection -->
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" class="form-control" required>
                                    @if (Auth::user()->branch_id)
                                        @foreach($products->where('branch_id', Auth::user()->branch_id) as $product)
                                            <option value="{{ $product->id }}" {{ $inventory->product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                        @endforeach
                                    @else
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $inventory->product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="{{ $inventory->quantity }}" required>
                            </div>
                            <div class="form-group">
                                <label for="min_quantity">Minimum Quantity</label>
                                <input type="number" name="min_quantity" class="form-control" value="{{ $inventory->min_quantity }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Inventory</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
