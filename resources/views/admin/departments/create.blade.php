@extends('layouts.app')
@section("departments","active")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.department.index')}}">Departments</a></li>
    <li class="breadcrumb-item active">Create Department</li>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            
            <div class="card-block">
                <h4 class="text-capitalize text-center">Department Photo</h4>
                <center class="m-t-30"> 
                    <img src="{{asset(asset("img/department.png"))}}" class="img-circle" width="150" id="profile-image">
                </center>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal form-material" method="POST" action="{{route("admin.department.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4">Department Name</label>
                        <div class="col-md-8">
                            <input type="text" placeholder="" class="form-control form-control-line" name="name">
                             @error("name")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-md-4">Department Image</label>
                        <div class="col-md-8">
                            <input type="file" accept="image/*" id="image-input"  name="image" class="form-control form-control-line">
                            @error("image")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@endsection

@section("scripts")
<script>

$("#image-input").change(function(e){
    var file=e.target.files[0]
    var link=URL.createObjectURL(file)
    $("#profile-image").attr("src",link)
})
    
</script>
@endsection