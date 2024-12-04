@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">Create Branch</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branches.index') }}">Branches</a></li>
                    <li class="breadcrumb-item active">Create Branch</li>
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
                    <h4 class="card-title">Create Branch</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('branches.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="branch_name">Branch Name</label>
                                <input type="text" name="branch_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Branch</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
