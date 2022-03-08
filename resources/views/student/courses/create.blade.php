@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Create Course</li>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            
            <div class="card-block">
                
                <center class="m-t-30"> 
                    <img src="{{asset(auth()->user()->department->image)}}" class="img-circle" width="150" id="profile-image">
                    <h4 class="text-capitalize text-center p-3">Department Name: {{auth()->user()->department->name}}</h4>
                </center>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal form-material" method="POST" action="{{route("teacher.course.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4">Course Name</label>
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
                        <label class="col-md-4">Course Code</label>
                        <div class="col-md-8">
                            <input type="text" placeholder="" class="form-control form-control-line" name="code">
                             @error("code")
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