@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Offered Courses</li>
@endsection
@section('content')
<div class="row">

    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-block table-responsive text-center">
                <form action="{{route('student.courses.add')}}" method="post">
                    @csrf
                    <table class="table" id="data-table">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->department->courses as $key=>$course)

                       @if(!auth()->user()->courses->contains("id",$course->id))
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$course->name}}</td>
                            <td>{{$course->code}}</td>
                            <td>  
                                <input type="checkbox" name="course_ids[]" multiple value="{{$course->id}}" style="opacity:1;position:absolute;left:90%;">
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        
                    </tbody>
                </table>
                 <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">submit</button>
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
</script>
@endsection