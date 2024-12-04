@extends('admin.app')
@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
          App setting 
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf

                <!-- Input for app title -->
                <div class="form-group">
                    <label for="app_title">Title</label>
                    <input type="text" class="form-control" id="app_title" name="app_title"
                        value="{{ $settings->app_title ?? '' }}">
                </div>
             <div class="form-group">
                    <label for="app_title">Footer Test</label>
                    <input type="text" class="form-control" id="app_title" name="footer_text"
                        value="{{ $settings->footer_title ?? '' }}">
                </div>
                <!-- Input for app logo -->
                <div class="form-group">
                    <label for="app_logo">App Logo</label>
                    <input type="file" class="dropify" id="app_logo" name="app_logo"
                        data-default-file="{{ isset($settings) ? Storage::url($settings->app_logo) : '' }}">
                </div>

                <!-- Input for login logo -->
                {{-- <div class="form-group">
                    <label for="login_logo">Logo</label>
                    <input type="file" class="dropify" id="login_logo" name="login_logo"
                        data-default-file="{{ isset($settings) ? Storage::url($settings->login_logo) : '' }}">
                </div> --}}

                <!-- Input for favicon logo -->
                <div class="form-group">
                    <label for="favicon_logo">Favicon Logo</label>
                    <input type="file" class="dropify" id="favicon_logo" name="favicon_logo"
                        data-default-file="{{ isset($settings) ? Storage::url($settings->favicon_logo) : '' }}">
                </div>
                <div class="form-group">
                    <label for="favicon_logo">Login Logo</label>
                    <input type="file" class="dropify" id="login_logo" name="login_logo"
                        data-default-file="{{ isset($settings) ? Storage::url($settings->login_logo) : '' }}">
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Save Setting</button>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>
@stop
