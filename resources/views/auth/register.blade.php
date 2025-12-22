@extends('master')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="form-label">Name</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="btn btn-link" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn btn-primary ms-4">
                {{ __('Register') }}
            </button>
        </div>
    </form>
@endsection
