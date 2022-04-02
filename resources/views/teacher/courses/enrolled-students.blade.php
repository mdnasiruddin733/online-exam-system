@extends('layouts.app')
@section("courses","active")
@section("breadcrumb")
   <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.course.index')}}">Courses</a></li>
    <li class="breadcrumb-item active">Enrolled Students</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-block table-responsive text-center">
                <table class="table table-stripped text-center" id="data-table">
                    <thead>
                        <tr>
                            <th>Student Roll</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Student Phone</th>
                            <th>
                                <a class="btn btn-danger" href="{{route('teacher.course.remove-all-enrollment',$course->id)}}">Remove All</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($course->students as $student)
                            
                            <tr>
                                <td>{{$student->roll}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td>
                                    <a href='{{route("teacher.course.remove-enrollment",['course_id'=>$course->id,'student_id'=>$student->id])}}' class="btn btn-danger">Remove</a>
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