@extends('layouts.app')
@section('content')
    <form class="form-section mt-5 py-5" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="container mt-4 mt-sm-0">
            <h1 class="h1 text-center mb-3 mb-md-5">Registration</h1>
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <form action="" class="login-form">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}" autocomplete="name" />
                            @error('name')
                            <div class="invalid-feedback" id="nameError">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter your username" value="{{ old('username') }}" autocomplete="username" />
                            @error('username')
                            <div class="invalid-feedback" id="usernameError">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" />
                            @error('password')
                            <div class="invalid-feedback" id="passwordError">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation" placeholder="Enter your password again" autocomplete="new-password" />
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <div class="mt-3">
                            Already have an account?  <a href="{{ route('login') }}" class="btn btn-link p-0">Login in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
@endsectionå
