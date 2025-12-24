<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Password</title>

    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/style.css') }}">
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
                <div class="card-body px-5 py-5">

                    <h3 class="card-title mb-3">Confirm Password</h3>

                    <p class="text-muted">
                        This is a secure area. Please confirm your password.
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

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

                        <div class="text-center">
                            <button class="btn btn-primary btn-block">Confirm</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
