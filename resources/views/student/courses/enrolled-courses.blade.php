@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Offered Courses</li>
@endsection
@section('content')
@if(count(auth()->user()->courses)>0)
<div class="row">
    @foreach(auth()->user()->courses as $course)
    <div class="col-lg-3 col-xlg-3 col-md-3">
        <a href="{{route('student.course.show',$course->id)}}">
        <div class="card">
            <div class="card-block" style="height:180px;">
               <center><strong style="color:hsl(332, 100%, 50%);">{{$course->code}}</strong></center>
               <hr>
               <center><b>{{$course->name}}</b></center>
            </div>
        </div>
        </a>
    </div>
    @endforeach
</div>
@else 
<div class="row">
    <center class="text-danger p-3">You are not enrolled in any courses</center>
</div>
@endif
@endsection

@section("scripts")
<script>
   
$('#data-table').DataTable();
</script>
@endsection