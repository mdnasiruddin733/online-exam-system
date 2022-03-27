@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Courses</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-4 text-center">
        <a href="{{route('teacher.exam.create')}}" class="btn btn-primary wave-effects">Create an exam</a>
    </div>
    @foreach (auth()->user()->exams as $exam)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center text-white bg-success">{{$exam->title}}</div>
                <div class="card-body">
                    <p><strong>Course Name:</strong><span class="pl-2">{{$exam->course->name}}</span></p>
                    <p><strong>Instructions:</strong><span class="pl-2">{{$exam->instructions}}</span></p>
                    <p><strong>Start Time:</strong><span class="pl-2">{{date("d M, Y || H:iA",strtotime($exam->started_at))}}</span></p>
                     <p><strong>End Time:</strong><span class="pl-2">{{date("d M, Y || H:iA",strtotime($exam->ended_at))}}</span></p>
                </div>
                <div class="card-footer text-center">
                   
                    <a href="{{route('teacher.exam.create-questions',$exam->id)}}" class="btn btn-success wave-effects">Assign Questions</a>
                    <a href="{{route('teacher.exam.edit',$exam->id)}}" class="btn btn-warning wave-effects"><i class="fas fa-pen"></i></a>
                    <button class="btn btn-danger wave-effects" onclick="confirm('Do you want to delete it?')? location.href='{{route('teacher.exam.delete',$exam->id)}}':''"><i class="fas fa-trash-o"></i></button>
                    
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section("scripts")
<script>
   

</script>
@endsection