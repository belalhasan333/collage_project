<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verification</title>

    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/style.css') }}">
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-5 mx-auto">
                <div class="card-body px-5 py-5">

                    <h3 class="card-title mb-3">Verify Email</h3>

                    <p class="text-muted">
                        Thanks for signing up! Please verify your email address by clicking the link we sent.
                    </p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mt-3">
                            A new verification link has been sent to your email.
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="btn btn-primary">Resend Email</button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-secondary">Logout</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
