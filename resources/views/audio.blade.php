@extends('layouts.app')

@section('content')
<form method="POST" id="audioClipForm" action="{{url('/upload-audio')}}">
    @csrf

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
    const form = document.getElementById('audioClipForm')

    toggleRecordButton.addEventListener('click', toggleRecording);

    form.addEventListener('submit', sendAudioToServer);

    async function toggleRecording() {
        if (isRecording) {
            stopRecording();
        } else {
            startRecording();
        }
    }

    async function startRecording() {
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

            //sendAudioToServer(audioBlob);
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

    async function sendAudioToServer(event) {
        event.preventDefault();
        const formData = new FormData();
        formData.append('audio', blob);

        const response = await fetch('/upload-audio', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            console.log('Audio uploaded successfully.');
        } else {
            const json = await response.json();
            console.log(json);
            console.error('Failed to upload audio.');
        }
    }
</script>
@endsection
