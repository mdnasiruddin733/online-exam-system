@extends('layouts.app')
@section("dashboard","active")
@section("breadcrumb")
    <li class="breadcrumb-item active">Home</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <h1 class="text-success">
                        <i class="fa fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                      </h1>
                    </div>
                    <div class="float-right">
                      <p class="card-text text-dark">Students</p>
                      <h4 class="bold-text">{{countStudents()}}</h4>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-md-4">
            <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <h1 class="text-primary">
                        <i class="fa fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                      </h1>
                    </div>
                    <div class="float-right">
                      <p class="card-text text-dark">Teachers</p>
                      <h4 class="bold-text">{{countTeachers()}}</h4>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-md-4">
            <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <h1 class="text-danger">
                        <i class="fa fas fa-school highlight-icon" aria-hidden="true"></i>
                      </h1>
                    </div>
                    <div class="float-right">
                      <p class="card-text text-dark">Departements</p>
                      <h4 class="bold-text">{{countDepartments()}}</h4>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection


