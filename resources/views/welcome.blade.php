@extends("layouts.frontend")
@section("content")
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                @guest
                    <a href="{{route("login.student")}}" class="btn btn-success">Login</a>
                    <a href="{{route("register.student")}}" class="btn btn-success">Register</a>
                 @endguest
                 @auth
                     <a href="{{route("dashboard.".guard())}}" class="btn btn-success">Home</a>
                 @endauth
            </div>
        </div>
    </div>
</div>
@endsection