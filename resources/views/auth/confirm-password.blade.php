@extends('master')

@section('content')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary ms-4">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
@endsection
