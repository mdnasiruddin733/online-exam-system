@extends('layouts.app')
@section("profile","active")

@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.profile')}}">Profile</a></li>
    <li class="breadcrumb-item active">Change Password</li>
@endsection

@section('content')
<div class="row">
    
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal form-material" method="POST" action="{{route("admin.change-password")}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3">Current Password</label>
                        <div class="col-md-9">
                            <input type="password"  class="form-control @error("current_password") is-invalid @enderror form-control-line" name="current_password" value="">
                            @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-3">New Password</label>
                        <div class="col-md-9">
                            <input type="password"  class="form-control @error("new_password") is-invalid @enderror form-control-line" name="new_password" value="">
                            @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-3">Confirm New Password</label>
                        <div class="col-md-9">
                            <input type="password"  class="form-control @error("password_confirmation") is-invalid @enderror form-control-line" name="password_confirmation" value="">
                            @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@endsection

