<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech2etc Ecommerce Tutorial</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="{{ asset('assets/shop/style.css') }}">
</head>

<body>
    {{-- header --}}
    @include('user.layout.header')
    {{-- end header --}}

   @yield('content')

    {{-- Footer --}}
    @include('user.layout.footer')


    <script src="{{ asset('assets/shop/script.js') }}"></script>
</body>

</html>
