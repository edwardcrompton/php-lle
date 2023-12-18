<li>
    <strong>Location:</strong> {{ $row->location_address }}<br>
    @if ($row->audio_path)
        <strong>Audio Path:</strong> {{ $row->audio_path }}<br>
        <audio id="audioPlayer" src="/storage/{{ $row->audio_path }}" controls></audio>
    @endif
    <a href="{{ $row->record_path }}">Update audio</a>
    <!-- You can add additional information here as needed -->
</li>