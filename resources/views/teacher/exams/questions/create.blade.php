@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">{{$exam->title}}</a></li>
    <li class="breadcrumb-item active">Create Question</li>
@endsection
@section('content')
<div class="row">
    <div class="com-md-12 text-center mb-2">
         <a href="{{route('teacher.exam.import-questions',$exam->id)}}" class="btn btn-primary wave-effects">Import questions from Excel</a>
    </div>
    @livewire("create-questions",["exam_id"=>$exam->id])
</div>
@endsection

@section("scripts")
<script>


</script>
@endsection