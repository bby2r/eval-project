@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Register</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create an Account</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </div>
@endsection
