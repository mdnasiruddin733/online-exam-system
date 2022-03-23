@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">My Courses</li>
@endsection

@section('content')
<div class="row">
    @foreach(auth()->user()->courses as $course)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5 class="card-title">{{$course->code}}</h5>
                <p class="card-text">
                    {{$course->name}}
                </p>
                <a href="#" class="btn btn-primary">Button</a>
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