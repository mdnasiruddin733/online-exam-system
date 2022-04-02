@extends('layouts.app')
@section("exams","active")
@section("breadcrumb")
   <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.exam.index')}}">Exams</a></li>
    <li class="breadcrumb-item active">Monitor</li>
@endsection

@section('content')
<div class="row">
    @livewire("monitor",["exam"=>$exam],key($exam->id))
</div>
@endsection

@section("scripts")
<script>
    $('#monitor-table').DataTable();
    window.Echo.private(`monitor.{{auth()->user()->id}}`)
            .listen('ExamLeftEvent', (event) => {
                window.livewire.emit("studentLeftExam");
        });
</script>
@endsection