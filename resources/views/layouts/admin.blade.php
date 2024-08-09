
<!DOCTYPE html>
<html>

<head>
    @include('admins.block.header')
    @yield('css')
</head>

<body>
<div id="wrapper">
{{--    sidebar--}}
        @include('admins.block.sidebar')
    <div id="page-wrapper" class="gray-bg">
{{--       nav--}}
        @include('admins.block.nav')
{{--        content--}}
        @yield('content')
        @include('admins.block.footer')
    </div>
</div>

<!-- Mainly scripts -->
@include('admins.block.script')
@yield('js')
</body>
</html>
