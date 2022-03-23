@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Departments</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-header"><a href="{{route('admin.department.create')}}" class="btn btn-success">Create New Department</a></div>
            <div class="card-block table-responsive text-center">
                <table class="table table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $key=>$department)
                        <tr>
                            <td style="line-height:80px;">{{++$key}}</td>
                            <td style="line-height:80px;"><img src="{{asset($department->image)}}" alt="" style="width:100px;height:80px;"></td>
                            <td style="line-height:80px;">{{$department->name}}</td>
                            <td style="line-height:80px;">
                                <a href="{{route('admin.department.edit',$department->id)}}" class="btn btn-primary">Edit</a>
                                <button class="btn btn-danger" onclick="confirm('Do you want to delete it?')? location.href='{{route('admin.department.delete',$department->id)}}':''">Delete</button>
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