@extends('layouts.app')

@section('content')
    <h1>{{ __('Search places') }}</h1>

    <p>{{ __('This list shows the latest audio clips.') }}</p>
    <p>{{ __('Search for a place name to add a new audio clip.') }}</p>

    @include('search-form')

    <ul>
        @foreach ($audioRecords as $row)
            @include('item')
        @endforeach
    </ul>

    {{ $audioRecords->links() }}
@endsection
