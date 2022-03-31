@extends("layouts.app")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0)">{{$result->exam->course->name}}</a></li>
     <li class="breadcrumb-item"><a href="javascript:void(0)">{{$result->exam->title}}</a></li>
    <li class="breadcrumb-item active">Result</li>
@endsection
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{$result}}
            </div>
        </div>
    </div>
@endsection