<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - 2024</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <h2>Admin Login</h2>
            <form action="{{ url('login_post') }}" method="post">
                {{ csrf_field() }}

                <!-- Email Input -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <!-- Password Input -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-btn">Login</button>

                <!-- Forgot Password Link -->
                <div class="forgot-password">
                    <a href="{{ url('forgot') }}">Forgot password?</a>
                </div>

                <!-- Registration Link -->
                <div class="register-link">
                    Don't have an account? <a href="{{ url('register') }}">Register here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
