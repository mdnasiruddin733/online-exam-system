@extends('layouts.app')
@section("my-courses","active")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.student')}}">Home</a></li>
    <li class="breadcrumb-item active">My Courses</li>
@endsection

@section('content')
<div class="row">
    @foreach(auth()->user()->courses as $course)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-center mb-4">
            <div class="card-header bg-success">
                <div class="card-title text-center"><h5 class="card-title text-light">{{$course->code}}</h5></div>
            </div>
            <div class="card-body">
                <p class="card-text">
                    {{$course->name}}
                </p>
                <a href="{{route("student.exam.index",$course->id)}}" class="btn btn-primary">Show Exams</a>
            </div>
            <div class="card-footer bg-white text-muted">Teacher: {{$course->teacher->name}}</div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section("scripts")
<script>

</script>
@endsection