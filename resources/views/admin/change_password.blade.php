@extends('admin.app')
<style>
    .invalid-feedback{
        color:red;
    }
    </style>
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a style="color: #5d596c;" href="javascript:void(0);">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="javascript:void(0);" >Change Password</a>
        </li>
      </ol>
    </nav>
  
                <div class="row">
                  <div class="col-md-12">
  
                    <!-- Change Password -->
                    <div class="card mb-4">
                      <h5 class="card-header">Change Password</h5>
                      <div class="card-body">
                        <form id="formAccountSettings" method="POST"  action="{{ url('admin/password/store') }}">
                          @csrf
                          <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                              <label class="form-label" for="currentPassword">Current Password</label>
                              <div class="input-group input-group-merge">
                                <input
                                  class="form-control"
                                  type="password"
                                  name="current_password"
                                  id="currentPassword"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                />
                              
                                @error('current_password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                              <label class="form-label" for="newPassword">New Password</label>
                              <div class="input-group input-group-merge">
                                <input
                                  class="form-control"
                                  type="password"
                                  id="newPassword"
                                  name="new_password"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                />
                                
                                @error('new_password')
              <span class="invalid-feedback"  style="display:block;" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
                              </div>
                            </div>
  
                            <div class="mb-3 col-md-6 form-password-toggle">
                              <label class="form-label" for="confirmPassword">Confirm New Password</label>
                              <div class="input-group input-group-merge">
                                <input
                                  class="form-control"
                                  type="password"
                                  name="new_password_confirmation"
                                  id="confirmPassword"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                />
                               
                              </div>
                            </div>
  
                            <div>
                              <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
  </div>
</section>
</div>
@stop
@section('js')
<script>
$(document).ready(function(){
    setTimeout(function(){
        $(".alert-success").fadeOut("slow", function(){
            $(this).remove();
        });
    }, 3000); // Remove the message after 3 seconds (adjust as needed)
});

function updatePassword() {
var current_password = $('#current_password').val();
var new_password = $('#new_password').val();
var confirm_password = $('#confirm_password').val();
var token = $('meta[name="csrf-token"]').attr('content');
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
url: 'admin/password/update',
type: 'POST',
data: {
current_password: current_password,
new_password: new_password,
confirm_password: confirm_password,
_token: token
},
success: function(response) {
swal("Success!", response.message, "success").then(() => {
window.location.href = "/dashboard";
});
$('form')[0].reset();
},
error: function(response) {
var errors = response.responseJSON.errors;
if (errors.hasOwnProperty('current_password')) {
$('#current_password').addClass('is-invalid');
$('#current_password').after('<div class="invalid-feedback">' + errors.current_password[0] + '</div>');
}
if (errors.hasOwnProperty('new_password')) {
$('#new_password').addClass('is-invalid');
$('#new_password').after('<div class="invalid-feedback">' + errors.new_password[0] + '</div>');
}
if (errors.hasOwnProperty('confirm_password')) {
$('#confirm_password').addClass('is-invalid');
$('#confirm_password').after('<div class="invalid-feedback">' + errors.confirm_password[0] + '</div>');
}
swal("Error!", response.responseJSON.message, "error");
}
});
}
</script>
@stop
