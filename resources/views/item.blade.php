<li>
    <strong>ID:</strong> {{ $row->id }}<br>
    <strong>Location:</strong> {{ $row->location_address }}<br>
    <strong>Audio Path:</strong> {{ $row->audio_path }}<br>
    <audio id="audioPlayer" src="/storage/{{ $row->audio_path }}" controls></audio>
    <!-- You can add additional information here as needed -->
</li>