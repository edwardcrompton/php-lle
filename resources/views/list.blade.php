@extends('layouts.app')

@section('content')
    <h1>Search places</h1>

    <form method="GET" enctype="multipart/form-data" id="placeSearchForm">
        @csrf

        <label for="placename">Place name</label>
        <input type="text" name="placename" id="placename" placeholder="Search for a placename"></input>
        <input type="submit" value="Search">
    </form>

    <ul>
        @foreach ($audioRecords as $record)
            <li>
                <strong>ID:</strong> {{ $record->id }}<br>
                <strong>Location:</strong> {{ $record->location_address }}<br>
                <strong>Audio Path:</strong> {{ $record->audio_path }}<br>
                <audio id="audioPlayer" src="/storage/{{ $record->audio_path }}" controls></audio>
                <!-- You can add additional information here as needed -->
            </li>
        @endforeach
    </ul>

    {{ $audioRecords->links() }}
@endsection
