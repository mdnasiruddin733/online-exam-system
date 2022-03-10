@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.course.index')}}">{{$course->name}}</a></li>
    <li class="breadcrumb-item active">Create Exam</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
         <div class="card-body">
                    <form method="POST" action="{{ route('teacher.exam.store') }}">
                        @csrf
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Exam Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

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
                                <textarea class="form-control @error('instructions') is-invalid @enderror" name="instructions" value="{{ old('instructions') }}" required rows="4"></textarea>

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

                                <select id="department" class="form-control @error('type') is-invalid @enderror" name="type"  required>
                                
                                <option value="cq">Written</option>
                                <option value="mcq">MCQ</option>
                               
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
                                
                               <input id="title" type="datetime-local" class="form-control @error('started_at') is-invalid @enderror" name="started_at" value="" required min="{{date('Y-m-d\TH:i', strtotime(now()))}}">

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
                                
                                 <input id="title" type="datetime-local" class="form-control @error('ended_at') is-invalid @enderror" name="ended_at" value="" required min="{{date('Y-m-d\TH:i', strtotime(now()))}}">

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
                                    {{ __('Create Exam') }}
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