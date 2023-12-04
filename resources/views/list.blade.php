@extends('layouts.app')

@section('content')
    <h1>Search places</h1>

    <form method="GET" enctype="multipart/form-data" id="placeSearchForm" action="{{ route('filter') }}">
        @csrf

        <label for="place">Place name</label>
        <input type="text" name="place" id="place" placeholder="Search for a place name"></input>
        <input type="submit" value="Search">
    </form>

    <ul>
        @foreach ($audioRecords as $row)
            @include('item')
        @endforeach
    </ul>

    {{ $audioRecords->links() }}
@endsection
