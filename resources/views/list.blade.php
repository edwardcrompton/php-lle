@extends('layouts.app')

@section('content')
    <h1>Audio Records</h1>

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
