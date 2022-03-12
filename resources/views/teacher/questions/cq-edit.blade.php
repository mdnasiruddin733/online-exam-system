@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.exam.index',$exam->course->id)}}">{{$exam->title}}</a></li>
    <li class="breadcrumb-item active">Create Questions</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
         <div class="card-body">
            <form method="post" action="{{route("teacher.cq.update")}}" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="exam_id" value="{{$exam->id}}">
                 <div class="row form-group">
                    <label for="" class="col-md-2">Upload Question:</label>
                    <div class="col-md-10">
                        <input type="file" accept="application/pdf" name="question" class="form-control">
                        @error("question")
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="" class="col-md-2">Marks:</label>
                    <div class="col-md-10">
                       <input type="number" name="marks" class="form-control" value="{{$exam->cq->marks}}">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                       <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>

</script>
@endsection