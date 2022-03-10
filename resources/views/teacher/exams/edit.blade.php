@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.course.index')}}">{{$exam->course->name}}</a></li>
    <li class="breadcrumb-item active">Edit Exam</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
         <div class="card-body">
                    <form method="POST" action="{{ route('teacher.exam.update') }}">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{$exam->id}}">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Exam Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $exam->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Exam Instructions:') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('instructions') is-invalid @enderror" name="instructions"  required rows="4">{{ $exam->instructions }}</textarea>

                                @error('instructions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Exam Type') }}</label>

                            <div class="col-md-6">

                                <select id="department" class="form-control @error('type') is-invalid @enderror" name="type"  required >
                                
                                <option value="cq" {{$exam->type=="cq"?'selected':''}}>Written</option>
                                <option value="mcq" {{$exam->type=="mcq"?'selected':''}}>MCQ</option>
                               
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Exam Start Time:') }}</label>

                            <div class="col-md-6">
                                
                                <input id="title" type="datetime-local" class="form-control @error('started_at') is-invalid @enderror" name="started_at" value="{{ date('Y-m-d\TH:i', strtotime($exam->started_at)) }}" required min="{{date('Y-m-d\TH:i', strtotime(now()))}}">

                                @error('started_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Exam End Time:') }}</label>

                            <div class="col-md-6">
                                
                                 <input id="title" type="datetime-local" class="form-control @error('ended_at') is-invalid @enderror" name="ended_at" value="{{ date('Y-m-d\TH:i', strtotime($exam->ended_at)) }}" required min="{{date('Y-m-d\TH:i', strtotime(now()))}}">

                                @error('ended_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Exam') }}
                                </button>
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