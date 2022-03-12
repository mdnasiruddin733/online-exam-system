
@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.exam.index',$exam->course->id)}}">{{$exam->title}}</a></li>
    <li class="breadcrumb-item active">Questions</li>
@endsection
@section('content')
<div class="row">
    @if($exam->cq)
   <div class="col-md-12">
       <div class="card p-2">
            <div class="card-body text-center">
                <strong>Full Marks:</strong>&nbsp;<span>{{$exam->cq->marks}}</span>
                <p class="my-3"><a href="{{route('teacher.cq.edit',$exam->id)}}" class="btn btn-success">Edit</a>&nbsp;
                <button onclick="confirm('Do you want to delete it?') ? location.href='{{route('teacher.cq.delete',$exam->id)}}' :'' " class="btn btn-danger">Delete</button></p>
            </div>
        </div>
       <iframe src="{{asset($exam->cq->file)}}" width="100%" height="500" style="border:none;" allowfullscreen="true">
      </iframe>
   </div>
   @else
       <h1 class="text-muted">No Questions Set Yet</h1>
   @endif
</div>
@endsection

@section("scripts")
<script>
 
</script>
@endsection