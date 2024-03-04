@extends('layouts.app')

@section('content')
<h1>{{ app('request')->input('name') }}</h1>
<form method="POST" enctype="multipart/form-data" id="audioClipForm" action="{{ $urllocaliser->route('upload') }}">
    @csrf

    <div id="address-container">
        <label for="address">{{ __('Location address') }}</label>
        <input type="text" name="location_address" id="address" value="{{ app('request')->input('location') }}"></input>
    </div>

    <div id="audio-container">
        <label for="audio">{{ __('Audio file') }}</label>
        <input id="audio" name="audio" type="file"></input>
    </div>

    <div id="controls">
        <button id="toggleRecord" type="button">{{ __('Start recording') }}</button>
        <audio id="audioPlayer" controls></audio>
    </div>
    
    <div id="save">
        <input type="submit" value="{{ __('Save') }}">
    </div>    
</form>
@endsection

@section('scripts')
<script>
    let mediaRecorder;
    let audioChunks = [];
    let isRecording = false;

    var labelStopRecording = {!! json_encode(__('Stop recording')) !!};
    var labelStartRecording = {!! json_encode(__('Start recording')) !!};

    const toggleRecordButton = document.getElementById('toggleRecord');
    const audioPlayer = document.getElementById('audioPlayer');
    
    // If JS is running we don't need to show the file upload field.
    document.getElementById('audio-container').style.display = 'none';

    toggleRecordButton.addEventListener('click', toggleRecording);

    async function toggleRecording(event) {
        if (isRecording) {
            stopRecording();
        } else {
            startRecording(event);
        }
    }

    async function startRecording(event) {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        mediaRecorder = new MediaRecorder(stream, {mimeType: 'audio/ogg;codecs=opus'});

        mediaRecorder.ondataavailable = event => {
            if (event.data.size > 0) {
                audioChunks.push(event.data);
            }
        };

        mediaRecorder.onstop = () => {
            const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
            const audioUrl = URL.createObjectURL(audioBlob);
            audioPlayer.src = audioUrl;

            const blob = document.getElementById('audio');

            let file = new File([audioBlob], "audio.wav", {type:"audio/wav", lastModified:new Date().getTime()});

            let container = new DataTransfer();
            container.items.add(file);
            audio.files = container.files;
        };

        mediaRecorder.start();
        isRecording = true;
        toggleRecordButton.textContent = labelStopRecording;
    }

    function stopRecording() {
        if (mediaRecorder && mediaRecorder.state === 'recording') {
            mediaRecorder.stop();
            isRecording = false;
            toggleRecordButton.textContent = labelStartRecording;
        }
    }

</script>
@endsection
