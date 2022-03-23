@extends("layouts.frontend")
@section("content")
<div class="row">
    <div class="col-md-6 mb-4 mt-5 mx-auto">
        <div class="card">
            <div class="bg-image hover-overlay ripple ripple-surface-light" data-mdb-ripple-color="light" style="height:100px;">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid" alt="Beach">
                <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                </a>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('register') }}">
                    @csrf

                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form2Example1" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required>
                        <label class="form-label" for="form2Example1" style="margin-left: 0px;">Name</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 88.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required>
                        <label class="form-label" for="form2Example1" style="margin-left: 0px;">Email address</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 88.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>

                    <!-- Phone input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form2Example1" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" required>
                        <label class="form-label" for="form2Example1" style="margin-left: 0px;">Phone</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 88.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>

                    <!-- Department input -->
                    <div class="form-outline mb-4">
                        <select id="form2Example1" class="form-control @error('phone') is-invalid @enderror" name="department_id" required>
                            <option value=""></option>
                            @foreach(departments() as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="form2Example1" style="margin-left: 0px;">Department</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 88.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>

                     <!-- Roll input -->
                    <div class="form-outline mb-4">
                        <input type="number" id="form2Example1" class="form-control @error('roll') is-invalid @enderror" name="roll" value="{{old('roll')}}" required>
                        <label class="form-label" for="form2Example1" style="margin-left: 0px;">Roll</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 88.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>
 

 
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control @error('password') is-invalid @enderror" name="password">
                        <label class="form-label" for="form2Example2" style="margin-left: 0px;">Password</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 64.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                        <label class="form-label" for="form2Example2" style="margin-left: 0px;">Retype Password</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 64.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>
                   
                    <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
                   
                    <div class="text-center">
                        <p>Already registered? <a href="{{route('login.student')}}">Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection