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
            <div class="card-header">
                <h3 class="text-center text-capitalize p-2">{{$guard}} Login</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('login.'.$guard) }}">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1" class="form-control @error('email') is-invalid @enderror" name="email">
                        <label class="form-label" for="form2Example1" style="margin-left: 0px;">Email address</label>
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
                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  name="remember"  {{ old('remember') ? 'checked' : '' }} id="form21Example3" autocompleted="">
                                <label class="form-check-label" for="form21Example3"> Remember me </label>
                            </div>
                        </div>
                        <div class="col">
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                             @endif
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4"> Sign in </button>
                    <!-- Register buttons -->
                    @if($guard=="student")
                    <div class="text-center">
                        <p>Not registered? <a href="{{route('register')}}">Register</a></p>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection