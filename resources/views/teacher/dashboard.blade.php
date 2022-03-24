@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

            <!-- Card image -->
            <div class="view overlay" style="height:200px;">
                <img class="card-img-top" src="{{asset('img/banner.jpg')}}"
                alt="Card image cap">
                <a href="#!">
                <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body text-center">

                <!-- Title -->
                <h4 class="card-title">Welcome to {{config('app.name')}}</h4>
                <!-- Text -->
                <p class="card-text mb-3">
                    It is an Online Examination System Management Panel
                </p>

            </div>

            </div>
            <!-- Card -->
        </div>
    </div>
</div>
@endsection