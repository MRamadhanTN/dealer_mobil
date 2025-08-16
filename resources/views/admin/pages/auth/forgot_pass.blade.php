<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('sb-admin-2/img/logo_favicon2.png') }}">
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4e73df, #224abe);
        }
        .login-card {
            max-width: 420px;
            margin: auto;
            border-radius: 15px;
            overflow: hidden;
        }
        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>

<body class="bg-gradient-primary">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <div class="card shadow-lg my-5 login-card">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('sb-admin-2/img/logo_favicon12.png') }}" alt="Logo" class="logo rounded-circle">
                        <h1 class="h5 text-gray-900">Forgot Password</h1>
                        <p class="text-muted">Masukkan email untuk menerima link reset password</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.forgot.password.post') }}" class="user">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user"
                                   placeholder="Enter Email Address..." required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            <i class="fas fa-paper-plane"></i> Kirim Link Reset
                        </button>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ route('admin.login') }}">Kembali ke Login</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
