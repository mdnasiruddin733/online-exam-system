
@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.course.index')}}">{{$course->name}}</a></li>
    <li class="breadcrumb-item active">Exams</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12 my-3">

           <a href="{{route('teacher.exam.create',$course->id)}}" class="btn btn-success">Create New Exam</a>

    </div>
    @foreach ($course->exams as $exam)
    <div class="col-lg-6 col-xlg-6 col-md-6">
        <div class="card card-block card-info">
           
                <h2  style="color:#fff;">Exam on: {{$exam->title}}</h2>
           
            <div class="card-body text-white">
                <p><strong>Course Code:&nbsp;</strong>{{$exam->course->code}}</p>
                <p><strong>Course Name:&nbsp;</strong>{{$exam->course->name}}</p>
               <p><strong>Exam Instructions:&nbsp;</strong>{{$exam->instructions}}</p>
               <p><strong>Start Time:&nbsp;</strong>{{date("d M, Y H:i A",strtotime($exam->started_at))}}</p>
               <p><strong>End Time:&nbsp;</strong>{{date("d M, Y H:i A",strtotime($exam->ended_at))}}</p>
               <div class="row">
                   <div class="col-md-4 mb-2">
                       <a href="" class="btn btn-secondary btn-block">Set Question</a>
                   </div>
                   <div class="col-md-4 mb-2"> <a href="{{route('teacher.exam.edit',$exam->id)}}" class="btn btn-warning btn-block">Edit</a></div>
                   <div class="col-md-4 mb-2"><button onclick="confirm('Do you want to delete it?') ? location.href='{{route('teacher.exam.delete',$exam->id)}}' :'' " class="btn btn-danger btn-block">Delete</button></div>
               </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section("scripts")
<script>
   
$('#data-table').DataTable();
</script>
@endsection