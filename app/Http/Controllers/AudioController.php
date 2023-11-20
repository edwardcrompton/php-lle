<?php

namespace App\Http\Controllers;

use App\Models\AudioRecord;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function uploadAudio(Request $request)
    {
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');

            $locationAddress = $request->input('location_address');

            // Store the audio file in the 'storage/app/audio' directory
            $path = $audio->store('audio', ['disk' => 'public']);

            // Create a new database record
            $record = new AudioRecord();
            $record->audio_path = $path;
            $record->location_address = $locationAddress;

            $record->save();

            return response()->json(['message' => 'Audio uploaded successfully']);
        }

        return response()->json(['message' => 'No audio file provided'], 400);
    }

    public function listAudio()
    {
        // Retrieve paginated audio records, typically with a specific number of records per page
        $audioRecords = AudioRecord::orderBy('id', 'DESC')->paginate(10);

        return view('list', compact('audioRecords'));
    }

}
