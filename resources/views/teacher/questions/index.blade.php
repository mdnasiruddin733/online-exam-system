@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.exam.index',$exam->id)}}">{{$exam->title}}</a></li>
    <li class="breadcrumb-item active">Create Questions</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
         <div class="card-body">
            <form method="post" action="{{route("teacher.question.store")}}">
                @csrf 
                <input type="hidden" name="exam_id" value="{{$exam->id}}">
                <div class="row form-group">
                    <label for="" class="col-md-2">Question:</label>
                    <div class="col-md-10">
                        <textarea id="question" name="question" class="form-control"></textarea>
                        @error("question")
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                 <div class="row form-group">
                    <label for="" class="col-md-2">Option-1:</label>
                    <div class="col-md-10">
                        <textarea id="option_1" name="option_1" required class="form-control"></textarea>
                        @error("option_1")
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                 <div class="row form-group">
                    <label for="" class="col-md-2">Option-2:</label>
                    <div class="col-md-10">
                        <textarea id="option_2" name="option_2" required class="form-control"></textarea>
                        @error("option_2")
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                 <div class="row form-group">
                    <label for="" class="col-md-2">Option-3:</label>
                    <div class="col-md-10">
                        <textarea id="option_3" name="option_3" required class="form-control"></textarea>
                        @error("option_3")
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                 <div class="row form-group">
                    <label for="" class="col-md-2">Option-4:</label>
                    <div class="col-md-10">
                        <textarea id="option_4" name="option_4" required class="form-control"></textarea>
                        @error("option_4")
                        <span class="invalid-feedback text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="" class="col-md-2">Answer:</label>
                    <div class="col-md-10">
                       <select name="answer" class="form-control">
                           <option value="1">Option-1</option>
                           <option value="2">Option-2</option>
                           <option value="3">Option-3</option>
                           <option value="4">Option-4</option>
                       </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="" class="col-md-2">Marks:</label>
                    <div class="col-md-10">
                       <input type="number" name="marks" class="form-control">
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
$(document).ready(function() {
  $('#question').summernote({
      height:100
  });
    $('#option_1').summernote({
      height:50
  });
    $('#option_2').summernote({
      height:50
  });
    $('#option_3').summernote({
      height:50
  });
    $('#option_4').summernote({
      height:50
  });
});

</script>
@endsection