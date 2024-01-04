<?php

namespace App\Http\Controllers;

use App\Models\AudioRecord;
use NominatimLaravel\Content\Nominatim;

class SearchController extends Controller
{
    public function __construct(Nominatim $searchApi) {
        $this->searchApi = $searchApi;
    }

    public function index(string $place) {

        $search = $this->searchApi->newSearch();
        $search->query($place);

        $results = $this->searchApi->find($search);

        $list = [];
        foreach ($results as $result) {
            $id = NULL;
            $audioPath = NULL;
            $location = $result['display_name'];

            $audioRecord = AudioRecord::select('id', 'audio_path')
                ->where('location_address', $result['display_name'])
                ->first();

            if ($audioRecord) {
                $id = $audioRecord->id;
                $audioPath = $audioRecord->audio_path;
            }

            $audio = new AudioRecord([
                'id' => $id,
                'type' => $result['type'],
                'name' => $result['name'],
                'location_address' => $location,
                'audio_path' => $audioPath,
                'osm_place_id' => $result['place_id'],
            ]);

            $list[] = $audio;
        }

        return view('search', [
            'place' => $place,
            'results' => $list,
        ]);
    }
}
