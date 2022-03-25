@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">{{$exam->title}}</a></li>
    <li class="breadcrumb-item active">Create Question</li>
@endsection
@section('content')
<div class="row">
    @livewire("create-questions",["exam_id"=>$exam->id])
</div>
@endsection

@section("scripts")
<script>


</script>
@endsection