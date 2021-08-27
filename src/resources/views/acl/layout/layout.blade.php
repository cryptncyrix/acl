<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('AclView::partials.head')
</head>
<body>
@include('AclView::partials.nav')
@yield('content')
@include('AclView::partials.footer')
@include('AclView::partials.footer-scripts')
</body>
</html>