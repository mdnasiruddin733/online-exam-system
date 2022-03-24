@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Teachers</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card p-3">
            <div class="card-header text-center">
                <a href="{{route('admin.teacher.create')}}" class="btn btn-success">Create New Teacher</a>
                <a href="{{route('admin.import.teacher')}}" class="btn btn-danger">Import From Excell</a>
            </div>
            <div class="card-block table-responsive text-center">
                <table class="table table-bordered" style="font-size:14px;" id="data-table">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                             <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $key=>$teacher)
                        <tr>
                            <td>{{++$key}}</td>
                            <td><img src="{{asset($teacher->image)}}" alt="" style="width:100px;height:80px;"></td>
                            <td>{{$teacher->name}}</td>
                            <td>{{$teacher->email}}</td>
                            <td>{{$teacher->phone}}</td>
                            <td>{{$teacher->department->name}}</td>
                            <td>
                                <a href="{{route('admin.teacher.edit',$teacher->id)}}" class="btn btn-primary">Edit</a>
                                <button class="btn btn-danger mt-2" onclick="confirm('Do you want to delete it?')? location.href='{{route('admin.teacher.delete',$teacher->id)}}':''">Delete</button>
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