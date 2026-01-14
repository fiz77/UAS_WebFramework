<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Ketjeh</title>

    <link rel="stylesheet" href="{{ asset('style/login_register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    {{-- Notifikasi --}}
   @if(session('flash'))
        <div class="alert alert-info">{{ session('flash') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="form-box login">
        <form action="{{ route('process.auth') }}" method="POST">
            @csrf
            <h1 style="color: #2C7B3F;">Login</h1>

            <div class="input-box">
                <input for="username" type="text" id="username" name="username" placeholder="Username" required>
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="input-box">
                <input for="psw_user" type="password" id="psw_user" name="psw_user" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <button type="submit" name="login" class="btn">Login</button>
        </form>
    </div>

    <div class="form-box register">
        <form action="{{ route('process.auth') }}" method="POST">
            @csrf
            <h1 style="color: #2C7B3F;">Registration</h1>

            <div class="input-box">
                <input for="username" type="text" id="username" name="username" placeholder="Username" required>
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="input-box">
                <input for="email_user" type="email" id="email_user" name="email_user" placeholder="Email" required>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="input-box">
                <input for="psw_user" type="password" id="psw_user" name="psw_user" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <button type="submit" name="register" class="btn">Register</button>
        </form>
    </div>

    <div class="toggle-box">
        <div class="toggle-panel toggle-left">
            <h1>Hello, Welcome!</h1>
            <p>Don't have an account?</p>
            <button class="btn register-btn">Register</button>
        </div>

        <div class="toggle-panel toggle-right">
            <h1>Welcome Back!</h1>
            <p>Already have an account?</p>
            <button class="btn login-btn">Login</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/login_register.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
