@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
    <li class="breadcrumb-item active">Import Teachers From Excel</li>
@endsection

@section('styles')
<style>
   .file-upload-wrapper{
       width:60%;
       height: 200px;
       background-color: hsl(0, 0%, 100%);
       border:2px dotted black;
   } 

.file-upload-wrapper label{
    position:absolute;
    left:50%;
    top:40%;
    transform:translate(-50%,-50%);
}
.file-upload-wrapper input{
    display: inline-block;
    width:100%;
    height:100%;
    appearance: none;
    opacity:0;
}
</style>
@endsection
@section('content')
<div class="row mx-auto">
    <div class="col-md-12 mb-4 text-center">
        <a href="{{asset('sample-teachers.xlsx')}}" download="sample-teachers.xlsx" class="btn btn-danger">Download Sample Excel File</a>
    </div>
    <div class="col-md-12 text-center">
        <form method="POST" action="{{ route('admin.import.teacher') }}" enctype="multipart/form-data">
                @csrf
                <div class="file-upload-wrapper mx-auto">
                    
                    <label id="label" class="text-muted">
                        @error('xl') 
                            <strong class="text-danger">{{$message}}</strong>
                        @else
                        <h2><i class="fa fa-upload d-block"></i></h2>
                        <p>Drag and drop a file or click</p>
                        @enderror
                    </label>
                    <input type="file" id="xl" class="file-upload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" name="xl"/>
                </div>
                
                <input type="submit" value="Upload" class="btn btn-success m-3">
        </form>
    </div>
    @if(Session::has('failures'))
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">All errors in your excel file:</div>
            <div class="card-body">
               <table class="table table-hover">
                   <thead>
                       <th>Row No.</th>
                       <th>Attribute</th>
                       <th>Errors</th>
                       <th>Value</th>
                   </thead>
                   <tbody>
                       @foreach (Session::get("failures") as $validation)
                       <tr>
                           <td>{{$validation->row()}}</td>
                           <td>{{$validation->attribute()}}</td>
                           <td>
                               <ul>
                                @foreach($validation->errors() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                               </ul>
                            </td>
                           <td>{{$validation->values()[$validation->attribute()]}}</td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section("scripts")
<script>
  $("#xl").change(function(e){
    $("#label").text(e.target.files[0].name)
  })
</script>
@endsection