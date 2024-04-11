<li>
    {{ $row->location_address }}<br>
    @if ($row->audio_path)
        <audio id="audioPlayer" src="/storage/{{ $row->audio_path }}" controls></audio>
    @endif
    <a href="{{ $row->getUpdatePath() }}">{{ __('Update audio') }}</a>
</li>