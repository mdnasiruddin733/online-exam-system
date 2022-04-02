@extends('layouts.app')
@section("exams","active")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.exam.index')}}">Exams</a></li>
    <li class="breadcrumb-item active">Create Exam</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-xlg-12 col-md-12">

        <div class="card">
            <div class="card-header bg-success text-white">
                <div class="card-title text-center">Enter Exam Details</div>
            </div>
            <div class="card-body">

                <form class="form-horizontal form-material" method="POST" action="{{route("teacher.exam.store")}}">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-4">Course</label>
                        <div class="col-md-8">
                            <select name="course_id" id="" class="form-control">
                                @foreach(auth()->user()->courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                                @endforeach
                            </select>
                             @error("course_id")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Exam Title</label>
                        <div class="col-md-8">
                            <input type="text" placeholder="" class="form-control form-control-line" name="title">
                             @error("title")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4">Instructions</label>
                        <div class="col-md-8">
                            <textarea placeholder="" class="form-control form-control-line" name="instructions"></textarea>
                             @error("instructions")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label class="col-md-4">Exam start time</label>
                        <div class="col-md-8">
                            <input type="datetime-local" placeholder="" class="form-control form-control-line" name="started_at"  required min="{{date('Y-m-d\TH:i', strtotime(now()))}}">
                             @error("started_at")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4">Exam end time</label>
                        <div class="col-md-8">
                            <input type="datetime-local" placeholder="" class="form-control form-control-line" name="ended_at"  required min="{{date('Y-m-d\TH:i', strtotime(now()))}}">
                             @error("ended_at")
                            <span class="invalid-feed-back" role="alert">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Submit</button>
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