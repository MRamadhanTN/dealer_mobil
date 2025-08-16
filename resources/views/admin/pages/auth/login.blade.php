<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('sb-admin-2/img/logo_favicon2.png') }}">
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
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
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
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
                        <h1 class="h5 text-gray-900">Welcome Back!</h1>
                        <p class="text-muted">Login to access your dashboard</p>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}" class="user">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control form-control-user"
                                   placeholder="Enter Email Address..." required>
                        </div>
                        <div class="form-group password-wrapper">
                            <input type="password" name="password"
                                   class="form-control form-control-user"
                                   placeholder="Password" id="password" required>
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                <label class="custom-control-label" for="remember">Remember Me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ route('forgot') }}">Lupa Password?</a>
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

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
