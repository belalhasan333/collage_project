@extends('master')

@section('content')
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required autofocus autocomplete="username" />
            @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="form-label">Password</label>

            <input type="password" name="password" class="form-control" required autocomplete="current-password" />
            @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="btn btn-link">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </form>
@endsection
