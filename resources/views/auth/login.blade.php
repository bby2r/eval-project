@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Login</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Welcome Back</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
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

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, password })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        document.getElementById('response').innerHTML = `Login successful! Token: ${data.token}`;
                        localStorage.setItem('token', data.token);
                    } else {
                        document.getElementById('response').innerHTML = `Error: ${data.error}`;
                    }
                })
                .catch(error => {
                    document.getElementById('response').innerHTML = `Error: ${error.message}`;
                });
        });
    </script>
@endsection
