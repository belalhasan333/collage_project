<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/css/vendor.bundle.base.css') }}">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.png') }}" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">

                        <h3 class="card-title text-left mb-3">Register</h3>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-control p_input @error('name') is-invalid @enderror"
                                       required autofocus>

                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control p_input @error('email') is-invalid @enderror"
                                       required>

                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control p_input @error('password') is-invalid @enderror"
                                       required>

                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control p_input"
                                       required>
                            </div>

                            <!-- Register Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">
                                    Register
                                </button>
                            </div>

                            <!-- Login Link -->
                            <p class="sign-up text-center mt-3">
                                Already have an Account?
                                <a href="{{ route('login') }}"> Login</a>
                            </p>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- plugins:js -->
<script src="{{ asset('Backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('Backend/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('Backend/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('Backend/assets/js/misc.js') }}"></script>
<script src="{{ asset('Backend/assets/js/settings.js') }}"></script>
<script src="{{ asset('Backend/assets/js/todolist.js') }}"></script>

</body>
</html>
