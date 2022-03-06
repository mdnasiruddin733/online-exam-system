@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Students</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-header"><a href="{{route('admin.student.create')}}" class="btn btn-success">Create New Student</a></div>
            <div class="card-block table-responsive text-center">
                <table class="table table-bordered" style="font-size:14px;">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Roll No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                             <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $key=>$student)
                        <tr>
                            <td>{{++$key}}</td>

                            <td>{{$student->roll}}</td>
                            <td><img src="{{asset($student->image)}}" alt="" style="width:100px;height:80px;"></td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->department->name}}</td>
                            <td>
                                <a href="{{route('admin.student.edit',$student->id)}}" class="btn btn-primary">Edit</a>
                                <button class="btn btn-danger mt-2" onclick="confirm('Do you want to delete it?')? location.href='{{route('admin.student.delete',$student->id)}}':''">Delete</button>
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
   
</script>
@endsection