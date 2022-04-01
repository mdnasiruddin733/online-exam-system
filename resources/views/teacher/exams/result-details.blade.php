

@php 
$count=0;
$my_answers=json_decode($result->my_answers,true);
$right_answers=json_decode($result->right_answers,true);
@endphp

@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Courses</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center bg-primary text-light">Student's Information</div>
            <div class="card-body">
                <p><strong>Name:</strong><span class="mx-2">{{$result->student->name}}</span></p>
                <p><strong>Email:</strong><span class="mx-2">{{$result->student->email}}</span></p>
                <p><strong>Roll:</strong><span class="mx-2">{{$result->student->roll}}</span></p>
            </div>
        </div>
    </div>
     <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center bg-primary text-light">Student's Result</div>
            <div class="card-body">
                <p><strong>Aquired Marks:</strong><span class="mx-2">{{$result->marks}}</span></p>
                <p><strong>Full Marks:</strong><span class="mx-2">{{array_sum($result->exam->questions->pluck('marks')->toArray())}}</span></p>
                <p><strong>Student Rank:</strong><span class="mx-2">{{$rank}}</span></p>
            </div>
        </div>
    </div>
</div>
<div class="row">

    @foreach($my_answers as $key=>$my_answer)
    @php 
        $count++;
        $question=$result->exam->questions->where('id',$key)->first();
        $right_answer=$right_answers[$key];
    @endphp
    <div class="col-md-12">
        <div class="card">
    
            <div class="card-header bg-{{$my_answer==$right_answer? "success" :"danger"}} text-light">
                <div class="row">
                    <div class="col-md-9">
                        ({{$count}})&nbsp;{{$question->text}}
                    </div>
                    <div class="col-md-3">
                        Marks:{{$question->marks}}&nbsp;||&nbsp;Negative Marks: {{$question->negative_marks}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach($question->options as $key=>$option)
                    @php
                    $class="dark";
                        if((in_array($option->id, $my_answer) && $option->correct)){
                            $class="success";
                        }elseif((in_array($option->id, $my_answer) && $option->correct==0)){
                            $class="danger";
                        }
                    @endphp
                    <div class="text-{{$class}}">
                        <span class="badge badge-{{$class}}">{{+$key}}</span>
                        <span>{{$option->text}}</span>
                        @if($class=="danger")
                        <span class="fas fa-times"></span>
                        @endif
                        @if($option->correct)
                        <span class="fas fa-check"></span>
                        @endif
                    </div>
                    
                @endforeach
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