<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
</head>
<body>
<!-- Header -->
@include('head')
<!-- Cart -->
@include('cart')

@yield('content')

@include('footer')
</body>
</html>
