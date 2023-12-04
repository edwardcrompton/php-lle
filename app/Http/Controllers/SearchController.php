<?php

namespace App\Http\Controllers;

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
            $list[] = (object)[
                'id' => NULL, // Fetch only if there's a corresponding db object.
                'type' => $result['type'],
                'name' => $result['name'],
                'location_address' => $result['display_name'],
                'audio_path' => NULL, // Fetch only if there's a db obj.
                'osm_place_id' => $result['place_id'],
            ];
        }

        return view('search', [
            'place' => $place,
            'results' => $list,
        ]);
    }
}
