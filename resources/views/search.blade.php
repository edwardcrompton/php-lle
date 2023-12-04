<h1>Search</h1>

<h2>Results for {{$place}}</h2>

<ul>
@foreach ($results as $row)
    @include('item')
@endforeach
</ul>
