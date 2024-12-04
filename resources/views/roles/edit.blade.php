@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">Edit Role</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit Role</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section id="edit-role">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Role: {{ $role->name }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <h5>Assign Permissions</h5>
                            @foreach ($permissions as $module => $perms)
                                <div class="module-permissions mb-3">
                                    <h6>{{ ucfirst($module) }}</h6>
                                    <div class="form-check">
                                        {{-- <input type="checkbox" class="form-check-input" id="select_all_{{ strtolower(str_replace(' ', '_', $module)) }}" onclick="toggleAll('{{ strtolower(str_replace(' ', '_', $module)) }}')" {{ count(array_intersect($assignedPermissions, $perms)) === count($perms) ? 'checked' : '' }} /> --}}
                                        {{-- <label class="form-check-label" for="select_all_{{ strtolower(str_replace(' ', '_', $module)) }}">Select All</label> --}}
                                    </div>
                                    @foreach ($perms as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission }}" id="permission_{{ strtolower(str_replace(' ', '_', $permission)) }}" {{ in_array($permission, $assignedPermissions) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="permission_{{ strtolower(str_replace(' ', '_', $permission)) }}">{{ ucfirst($permission) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <hr />
                            @endforeach

                            <button type="submit" class="btn btn-primary">Update Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // function toggleAll(module) {
    //     const checkboxes = document.querySelectorAll(`input[name="permissions[]"][data-module="${module}"]`);
    //     const selectAllCheckbox = document.getElementById(`select_all_${module}`);
    //     checkboxes.forEach((checkbox) => {
    //         checkbox.checked = selectAllCheckbox.checked;
    //     });
    // }
</script>
@endsection
