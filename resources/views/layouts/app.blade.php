<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Audio Recorder</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav>
    @foreach(config('app.available_locales') as $locale)
        <a href="{{ route(Route::currentRouteName(), $locale) }}">{{ strtoupper($locale) }}</a>
    @endforeach
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
