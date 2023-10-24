<!doctype html>
<html>
<head>
{{--    @include('includes.head')--}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
