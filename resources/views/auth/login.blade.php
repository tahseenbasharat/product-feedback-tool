@extends('layouts.app')
@section('content')
    <form class="form-section mt-5 py-5" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container mt-4 mt-sm-0">
            <h1 class="h1 text-center mb-3 mb-md-5">Login</h1>
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
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
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" autocomplete="new-password" />
                        @error('password')
                        <div class="invalid-feedback" id="passwordError">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="mt-3">
                        Don't have an account? <a href="{{ route('register') }}" class="btn btn-link p-0">Create</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsectionå
