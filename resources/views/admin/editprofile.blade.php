@extends('admin.app')
@section('title','My Profile')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .invalid-feedback{
        color:red;
    }
    .dropify-wrapper {
            position: relative!important;
            /* width: 200px;
            height: 200px; */
            width: 170px!important;
    height: 170px!important;
            border-radius: 50%;
            border: 2px dashed #ccc;
            background-color: #fff; /* Set the background color to white */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            cursor: pointer;
            overflow: hidden;
        }

        .dropify-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            /* margin-top: -1.3rem; */
        }

        .arrow-icon {
            position: absolute;
            /* top: 50%;
            left: 50%; */
            right: 5%;
            top: 15%;
            /* transform: translate(-50%, -50%); */
            width: 40px;
            height: 40px;
            /* background-image: url('arrow-icon.png');
            background-size: cover; */
            z-index: 2;
        }
/* Hide the "Choose File" text in the file input */
.dropify-wrapper input[type="file"]::-webkit-file-upload-button {
    font-size: 0;
    position: absolute;
    z-index: -9999;
    opacity: 0;
}

.switch {
            position: relative;
            display: inline-block;
            width: 55px;
            height: 25px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 20px;
            left: 3px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #7367f0;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #7367f0;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@section('content')
{{-- {{dd($form)}} --}}
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="color: #5d596c;" href="javascript:void(0);">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="javascript:void(0);" >My Profile</a>
          </li>
        </ol>
      </nav>
<section class="card">
    <header class="card-header">
		<div class="row">
			<div class=""><h4 style="">Profile Update</h4></div>

		</div>
	</header>
    @if (Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! Session::get('error') !!}</li>
        </ul>
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class= "card-body ">
<form method="POST" action="{{ url('profile/update')}}" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class= "col-lg-12" style="display:flex; justify-content:center;">
        <!-- <label for="current_password">Profile image</label> -->
        <div class="dropify-wrapper" onclick="document.getElementById('file-input').click()">
            <div style="position: relative;">
                <div >
                    <img src="{{ asset(getUserProfileImage()) }}" alt="Profile Image">
                </div>
            </div>

        <div class="arrow-icon"><i class="menu-icon tf-icons fa fa-pencil"></i></div>
        <input type="file" id="file-input" name="profile_image" onchange="handleFileSelect(event)" style="color: white;">
    </div>
</div>
<div class="col-md-12 row form-group mt-5">
    <!--here-->
    <div class="mb-3 col-md-6">
        <label for="new_password" style="">First name</label>
        <input id="new_password" type="text" class="form-control" value="{{auth()->user()->first_name}}" name="first_name" >
    </div>
    <div class="mb-3 col-md-6">
        <label for="new_password" style="">Last Name</label>
        <input id="new_password" type="text" class="form-control" value="{{auth()->user()->last_name}}" name="last_name" >
    </div>
        <div class="mb-3 col-md-6">
            <label for="new_password" style="">Name</label>
            <input id="new_password" type="text" class="form-control" value="{{auth()->user()->username}}" name="name" readonly>
        </div>
        <div class="mb-3 col-md-6">
            <label for="new_password" style="">Email</label>
            <input id="new_password" type="email" class="form-control" value="{{auth()->user()->email}}" name="email" readonly>
        </div>

    <!--here-->

</div>
<div class="col-md-12">
    <button type="submit" class="btn btn-primary" style="margin-top:20px;float:left;">Update</button>
</div>

</form>
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
        function handleFileSelect(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
        var dropifyWrapper = document.querySelector('.dropify-wrapper');

        // Remove the existing image if it exists
        var existingImage = dropifyWrapper.querySelector('img');
        if (existingImage && existingImage.parentNode) {
            existingImage.parentNode.removeChild(existingImage);
        }

        // Create a new image element and set its source
        var newImage = document.createElement('img');
        newImage.src = e.target.result;
        newImage.alt = 'Profile Image';
        newImage.style.width = '100%';
        newImage.style.height = '100%';
        newImage.style.objectFit = 'cover';
        newImage.style.borderRadius = '50%';
        newImage.style.position = 'relative';
        newImage.style.top = '-22px';

        // Append the new image to the dropify wrapper
        dropifyWrapper.appendChild(newImage);
    };

    reader.readAsDataURL(selectedFile);
}

    </script>
@stop
