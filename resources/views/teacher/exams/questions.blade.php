
@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.exam.index',$exam->course->id)}}">{{$exam->title}}</a></li>
    <li class="breadcrumb-item active">Questions</li>
@endsection
@section('content')
<div class="row">
    @if(count($exam->questions)>0)
    @foreach($exam->questions as $key => $question)
        <div class="col-md-12">
            <div class="card p-3">
                <p><b>{{++$key}}.&nbsp;</b>{!! $question->question !!}</p>
                    <ol style="list-style-type:upper-alpha;">
                        <li class="{{$question->answer==1?"text-success":""}}">{!! $question->option_1!!}</li>
                        <li class="{{$question->answer==2?"text-success":""}}">{!! $question->option_2!!}</li>
                        <li class="{{$question->answer==3?"text-success":""}}">{!! $question->option_3!!}</li>
                        <li class="{{$question->answer==4?"text-success":""}}">{!! $question->option_4!!}</li>
                    </ol>
                <p><strong>Answer:&nbsp;{{['A','B','C','D'][ $question->answer-1]}} &nbsp;||&nbsp; Marks: {{$question->marks}}</strong></p>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{route('teacher.question.edit',$question->id)}}" class="btn btn-primary">Edit</a>
                        <button onclick="confirm('Do you want to delete it?') ? location.href='{{route('teacher.question.delete',$question->id)}}' :'' " class="btn btn-danger">Delete</button>
                    </div>
                </div>
             </div>
        </div>
    @endforeach
    @else 
    <h3 class="text-muted">No Questions Set Yet</h3>
    @endif
</div>
@endsection

@section("scripts")
<script>
    $('#data-table').DataTable();
</script>
@endsection