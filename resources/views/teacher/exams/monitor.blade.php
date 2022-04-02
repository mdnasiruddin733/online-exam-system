@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Courses</li>
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