<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-container">
            <h2>Admin Registration</h2>
            <form method="POST" action="{{ url('registration_post') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Enter your name" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="shop_name">Shop Name</label>
                        <input type="text" id="shop_name" name="shop_name" value="{{ old('shop_name') }}"
                            placeholder="Enter shop name" required>
                        @error('shop_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            placeholder="Enter your address" required>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                            placeholder="Enter your phone number" required>
                        @error('phone_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Enter your email" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm your password" required>
                    </div>

                    <div class="input-group">
                        <label for="image">Shop Image</label>
                        <input type="file" id="image" name="image">
                        @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="login-btn">Register</button>

                <div class="forgot-password">
                    <a href="{{ url('login') }}">Already have an account? Login here</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
