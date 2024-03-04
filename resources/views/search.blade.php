<h1>{{ __('Search') }}</h1>

<h2>{{ __('Results for :place', ['place' => $place]) }}</h2>

<ul>
@foreach ($results as $row)
    @include('item')
@endforeach
</ul>
