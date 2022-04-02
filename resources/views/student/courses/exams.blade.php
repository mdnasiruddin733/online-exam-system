@extends('layouts.app')
@section("my-courses","active")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.student')}}">Home</a></li>
    <li class="breadcrumb-item active">Exams</li>
     
@endsection

@section('content')

@if(count($course->exams)<1)
<h1 class="text-danger text-center">No exam found for this course</h1>
@else 

<div class="row">
    @foreach($course->exams as $exam)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-center mb-4">
            <div class="card-header bg-success">
                <div class="card-title text-center"><h5 class="card-title text-light">{{$exam->title}}</h5></div>
            </div>
            <div class="card-body">
                <p> <strong>Start time:</strong><span> {{date("d M, Y || g:iA",strtotime($exam->started_at))}}</span></p>
                <p> <strong>End time:</strong><span> {{date("d M, Y || g:iA",strtotime($exam->ended_at))}}</span></p>


                @if(strtotime($exam->started_at) > strtotime(now()))
                    <span class="text-warning">Exam not started</span>
                @elseif(strtotime($exam->started_at) < strtotime(now()) && strtotime(now()) < strtotime($exam->ended_at))
                    @if($exam->results->where("student_id",auth()->user()->id)->first())
                     <a href="{{route('student.exam.participate',$exam->id)}}" class="btn btn-primary">View Result</a>
                    @else 
                   <a href="{{route('student.exam.participate',$exam->id)}}" class="btn btn-success">Participate</a>
                   @endif
                @elseif(strtotime($exam->ended_at) < strtotime(now()))
                    @if($exam->results->where("student_id",auth()->user()->id)->first())
                     <a href="{{route('student.exam.result',$exam->id)}}" class="btn btn-primary">View Result</a>
                    @else 
                    <span class="text-danger">Exam ended and you didn't participate</span>
                    @endif
                    <p class="my-2"><a href="{{route("student.exam.download", $exam->id)}}" class="btn btn-default">Show Question</a></p>
                @endif
                

            </div>
            <div class="card-footer bg-white text-muted">Teacher: {{$course->teacher->name}}</div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection

@section("scripts")
<script>

</script>
@endsection