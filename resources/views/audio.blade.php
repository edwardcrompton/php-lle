@extends('layouts.app')

@section('content')
<div>
    <button id="toggleRecord">Start Recording</button>
    <audio id="audioPlayer" controls></audio>
</div>
@endsection

@section('scripts')
<script>
    let mediaRecorder;
    let audioChunks = [];
    let isRecording = false;

    const toggleRecordButton = document.getElementById('toggleRecord');
    const audioPlayer = document.getElementById('audioPlayer');

    toggleRecordButton.addEventListener('click', toggleRecording);

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
            sendAudioToServer(audioBlob);
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

    async function sendAudioToServer(blob) {
        const formData = new FormData();
        formData.append('audio', blob);

        const response = await fetch('/upload-audio', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            console.log('Audio uploaded successfully.');
        } else {
            console.error('Failed to upload audio.');
        }
    }
</script>
@endsection
