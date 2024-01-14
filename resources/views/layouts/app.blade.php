<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Audio Recorder</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <li><a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i>en</a></li>
    <li><a href="{{ url('locale/cy') }}" ><i class="fa fa-language"></i>cy</a></li>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
