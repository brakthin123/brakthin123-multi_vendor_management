<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcom.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            MyWebsite
                {{-- <img src="path-to-logo.png" alt="Logo" style="height: 40px;"> --}}

        </div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Content</a></li>
            <li><a href="#">Service</a></li>
        </ul>
        <div class="auth-links">
            <a href="{{ url('login') }}">Login</a>
            <a href="{{ url('registration') }}">Register</a>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
        <h1>Welcome to Our Website</h1>
        <img src="https://via.placeholder.com/600x400" alt="Placeholder Image">
        <p>Explore our content and services. We're here to help you with the best experiences!</p>
    </div>
</body>

</html>
