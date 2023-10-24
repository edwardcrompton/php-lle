<!doctype html>
<html>
<head>
{{--    @include('includes.head')--}}
    <script defer src="http://unpkg.com/alpinejs@3.13.2/dist/cdn.min.js"></script>
</head>
<body>
<div class="container">
    <header class="row">
{{--        @include('includes.header')--}}
    </header>
    <div id="main" class="row">
        @yield('content')
    </div>
    <footer class="row">
{{--        @include('includes.footer')--}}
    </footer>
</div>
</body>
</html>
