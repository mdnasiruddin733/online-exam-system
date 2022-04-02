@extends('layouts.app')
@section("exams","active")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route("dashboard.teacher")}}">Home</a></li>
     <li class="breadcrumb-item"><a href="{{route('teacher.exam.index')}}">Exams</a></li>
    <li class="breadcrumb-item active">Results</li>
@endsection

@section('content')
<div class="row">
    @livewire("result",["exam"=>$exam],key($exam->id))
</div>
@endsection

@section("scripts")
<script>
    $('#result-table').DataTable();
</script>
@endsection