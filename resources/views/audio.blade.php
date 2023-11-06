@extends('layouts.app')

@section('content')
<form method="POST" enctype="multipart/form-data" id="audioClipForm" action="{{url('/upload-audio')}}">
    @csrf

    <label for="address">Location address</label>
    <input type="text" name="location_address" id="address"></input>

    <label for="audio">Audio file</label>
    <input id="audio" name="audio" type="file"></input>

    <button id="toggleRecord" type="button">Start Recording</button>
    <audio id="audioPlayer" controls></audio>

    <input type="submit" value="Save">
</form>
@endsection

@section('scripts')
<script>
    let mediaRecorder;
    let audioChunks = [];
    let isRecording = false;

    const toggleRecordButton = document.getElementById('toggleRecord');
    const audioPlayer = document.getElementById('audioPlayer');

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
        mediaRecorder = new MediaRecorder(stream);

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
        toggleRecordButton.textContent = 'Stop Recording';
    }

    function stopRecording() {
        if (mediaRecorder && mediaRecorder.state === 'recording') {
            mediaRecorder.stop();
            isRecording = false;
            toggleRecordButton.textContent = 'Start Recording';
        }
    }

</script>
@endsection
