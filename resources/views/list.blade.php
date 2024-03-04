@extends('layouts.app')

@section('content')
    <h1>{{ __('Search places') }}</h1>

    <p>{{ __('This list shows the latest audio clips.') }}</p>
    <p>{{ __('Search for a place name to add a new audio clip.') }}</p>

    <form method="GET" enctype="multipart/form-data" id="placeSearchForm" action="{{ $urllocaliser->route('filter') }}">
        @csrf

        <label for="place">{{ __('Place name') }}</label>
        <input type="text" name="place" id="place" placeholder="{{ __('Search for a place name') }}"></input>
        <input type="submit" value="{{ __('Search') }}">
    </form>

    <ul>
        @foreach ($audioRecords as $row)
            @include('item')
        @endforeach
    </ul>

    {{ $audioRecords->links() }}
@endsection
