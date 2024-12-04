@extends('admin.app')

@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper col-12">
                <h3 class="content-header-title float-left mb-0">Edit User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section id="edit-user">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User Details</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                              <!-- Display Success Message -->
                              @if(session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{ session('success') }}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                          @endif
  
                          <!-- Display Error Messages -->
                          @if($errors->any())
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <ul>
                                      @foreach($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                          @endif
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required pattern="^[a-zA-Z0-9]+$" title="Only alphanumeric characters are allowed.">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" 
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}"
                                       title="Must contain at least 8 characters, including 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.">
                                <small class="form-text text-muted">Leave blank if you don’t want to change the password.</small>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}"
                                       title="Must match the password entered above.">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            </div>

                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select name="branch_id" class="form-control">
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->branch_id }}" {{ $user->branch_id == $branch->branch_id ? 'selected' : '' }}>
                                            {{ $branch->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role_id" class="form-control" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <input type="file" name="image" class="form-control">
                                @if($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Update User</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
