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
            $audioRecord = AudioRecord::select('id', 'audio_path')
                ->where('location_address', $result['display_name'])
                ->first();

            $id = NULL;
            $audioPath = NULL;

            if ($audioRecord) {
                $id = $audioRecord->id;
                $audioPath = $audioRecord->audio_path;
            }

            $list[] = (object)[
                'id' => $id,
                'type' => $result['type'],
                'name' => $result['name'],
                'location_address' => $result['display_name'],
                'audio_path' => $audioPath,
                'osm_place_id' => $result['place_id'],
            ];
        }

        return view('search', [
            'place' => $place,
            'results' => $list,
        ]);
    }
}
