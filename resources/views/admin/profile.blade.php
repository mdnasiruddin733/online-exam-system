@extends('layouts.app')
@section("profile","active")
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-block">
                <input type="file" accept="image/*" id="image-input" style="display:none;">
                <center class="m-t-30"> <img src="{{asset(auth()->user()->image)}}" class="img-circle" width="150" id="profile-image">
                    <h4 class="card-title m-t-10">Name:&nbsp;{{auth()->user()->name}}</h4>
                    <h6 class="card-subtitle">Role:&nbsp;{{guard()}}</h6>
                    <button class="btn btn-primary btn-block" id="change-image">Change Profile Image</button>
                   
                    <a href="{{route('admin.change-password')}}" class="btn btn-primary btn-block text-white">Change Password </a>
                </center>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-block">
                <form class="form-horizontal form-material" method="POST" action="{{route("admin.update-profile")}}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12">Full Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" name="name" value="{{auth()->user()->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="email" id="example-email" value="{{auth()->user()->email}}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-12">Phone No</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="123 456 7890" class="form-control form-control-line" name="phone" value="{{auth()->user()->phone}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@endsection

@section("scripts")
<script>
    $("#change-image").click(function(){
        $("#image-input").click()
        $("#image-input").change(function(e){
            var file=e.target.files[0]
            var link=URL.createObjectURL(file)
            $("#profile-image").attr("src",link)
            var formdata=new FormData()
            formdata.append("image",file)
            formdata.append("_token","{{csrf_token()}}")
            $.ajax({
                type:"POST",
                url:"{{route('admin.change-profile-image')}}",
                processData:false,
                contentType:false,
                data:formdata,
                success:function(res){
                   Swal.fire({
                        position: 'top-center',
                        icon: "success",
                        title: res.data,
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error:function(error){
                    console.log("Something went wrong")
                }
            })
        })
    })
</script>
@endsection