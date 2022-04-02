@extends('layouts.app')
@section("courses","active")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.course.index')}}">Courses</a></li>
    <li class="breadcrumb-item active">Add Student</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-block table-responsive text-center">
                <form action="{{route('teacher.course.add-all-students')}}" method="post">
                            @csrf 
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                <table class="table table-bordered text-center" id="data-table">
                    <thead>
                        <tr>
                            <th>Student Roll</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Student Phone</th>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="all-select">
                                    <label class="form-check-label" for="all-select">Select All</label>
                                   
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($students as $student)
                            @if(!$student->courses->contains("id",$course->id))
                            <tr>
                                <td style="line-height:80px;">{{$student->roll}}</td>
                                <td style="line-height:80px;">{{$student->name}}</td>
                                <td style="line-height:80px;">{{$student->email}}</td>
                                <td style="line-height:80px;">{{$student->phone}}</td>
                                <td style="line-height:100px;">
                                    <div class="form-check">
                                        <input class="form-check-input student-checkbox" type="checkbox"name="student_ids[]" multiple value="{{$student->id}}" id="{{$student->id}}">
                                        <label class="form-check-label" for="{{$student->id}}">
                                        
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                       
                    </tbody>
                </table>
                <div class="row my-3">
                    <div class="col-md-12">
                         <button class="btn btn-success wave-effects" type="submit">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section("scripts")
<script>
   
$('#data-table').DataTable();
var checked=false
$("#all-select").change(function(){
     checked=!checked
    $(".student-checkbox").attr("checked",checked)
})
</script>
@endsection