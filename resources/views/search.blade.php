<h1>Search</h1>

<h2>Results for {{$place}}</h2>

<ul>
@foreach ($results as $result)
    <li><a href="{{ url('/audio/record?location=' . urlencode($result['address'])) . '&name=' . urlencode($result['name']) }}">{{ $result['address'] }}</a></li>
@endforeach
</ul>
