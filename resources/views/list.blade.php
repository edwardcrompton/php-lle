@extends('layouts.app')

@section('content')
    <h1>{{ __('Search places') }}</h1>

    <p>Listed below are the place names that already have an audio file associated with them.</p>
    <p>Search for a place name below to see all matching places. Audio files will be shown if they already exist.</p>

    <form method="GET" enctype="multipart/form-data" id="placeSearchForm" action="{{ $urllocaliser->route('filter') }}">
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
