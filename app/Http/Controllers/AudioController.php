<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function uploadAudio(Request $request)
    {
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $path = $audio->store('audio'); // Store the audio file in the 'storage/app/audio' directory

            // Create a new database record
            $record = new AudioRecord();
            $record->audio_path = $path;
            $record->save();

            return response()->json(['message' => 'Audio uploaded successfully']);
        }

        return response()->json(['message' => 'No audio file provided'], 400);
    }
}
