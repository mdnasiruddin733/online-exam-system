@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Courses</li>
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