@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Edit Student</li>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            
            <div class="card-block">
                <h4 class="text-capitalize text-center">Student's Photo</h4>
                <center class="m-t-30"> 
                    <img src="{{asset(asset($student->image))}}" class="img-circle" width="150" id="profile-image">
                    <p class="my-2 p-3">Joined {{$student->created_at->format('d M,Y')}}</p>
                </center>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal form-material" method="POST" action="{{route("admin.student.update")}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$student->id}}">
                     <div class="form-group row">
                        <label class="col-md-4">Roll No.</label>
                        <div class="col-md-8">
                            <input type="roll" placeholder="" class="form-control form-control-line" name="roll" value="{{$student->roll}}">
                            @error("roll")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Name</label>
                        <div class="col-md-8">
                            <input type="text" placeholder="" class="form-control form-control-line" name="name" value="{{$student->name}}">
                            @error("name")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Email</label>
                        <div class="col-md-8">
                            <input type="email" placeholder="" class="form-control form-control-line" name="email" value="{{$student->email}}">
                            @error("email")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Phone</label>
                        <div class="col-md-8">
                            <input type="phone" placeholder="" class="form-control form-control-line" name="phone" value="{{$student->phone}}">
                            @error("phone")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4">Department </label>
                         <div class="col-md-8">

                                <select id="department" class="form-control @error('department_id') is-invalid @enderror" name="department_id"  required>
                                @foreach(departments() as $department)
                                <option value="{{$department->id}}" {{$department->name==$student->department->name? "selected":""}}>{{$department->name}}</option>
                                @endforeach
                                </select>

                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
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