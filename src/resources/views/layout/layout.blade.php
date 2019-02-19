<!DOCTYPE html>
<html lang="en">
<head>
    @include('Acl::partials.head')
</head>

<body>

@include('Acl::partials.nav')

@yield('content')

@include('Acl::partials.footer')

@include('Acl::partials.footer-scripts')


</body>
</html>