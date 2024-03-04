<?php

namespace App\Http\Controllers;

use App\Models\AudioRecord;
use Illuminate\Http\Request;
use App\Services\UrlLocaliser;

class AudioController extends Controller
{
    protected $urlLocaliser;

    public function __construct(UrlLocaliser $urlLocaliser) {
        $this->urlLocaliser = $urlLocaliser;
    }

    public function upload(Request $request)
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

            flash('Audio uploaded successfully.')->success();
            return $this->urlLocaliser->redirect('index');
        }
        flash('No audio file was provided.')->error();
        return $this->urlLocaliser->redirect('record');
    }

    public function record() {
        $urllocaliser = $this->urlLocaliser;
        return view('audio', compact('urllocaliser'));
    }

    public function list()
    {
        // Retrieve paginated audio records.
        $audioRecords = AudioRecord::orderBy('id', 'DESC')->paginate(10);
        $urllocaliser = $this->urlLocaliser;

        return view('list', compact('audioRecords', 'urllocaliser'));
    }

}
