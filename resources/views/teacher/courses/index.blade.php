@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Courses</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-header"><a href="{{route('teacher.course.create')}}" class="btn btn-success">Create New Course</a></div>
            <div class="card-block table-responsive text-center">
                <table class="table table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Exam</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $key=>$course)
                        <tr>
                            <td style="line-height:80px;">{{++$key}}</td>
                            <td style="line-height:80px;">{{$course->name}}</td>
                            <td style="line-height:80px;">{{$course->code}}</td>
                            <td style="line-height:80px;">
                                <a href="{{route('teacher.exam.index',$course->id)}}" class="btn btn-primary">Manage Exam</a>
                            <td style="line-height:80px;">
                                <a href="{{route('teacher.course.edit',$course->id)}}" class="btn btn-primary">Edit</a>
                                <button class="btn btn-danger" onclick="confirm('Do you want to delete it?')? location.href='{{route('teacher.course.delete',$course->id)}}':''">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section("scripts")
<script>
   
$('#data-table').DataTable();
</script>
@endsection