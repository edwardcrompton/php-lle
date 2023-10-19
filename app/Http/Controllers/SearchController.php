<?php

namespace App\Http\Controllers;

use NominatimLaravel\Content\Nominatim;

class SearchController extends Controller
{
    public function __construct() {
        $this->searchApi = new Nominatim('http://nominatim.openstreetmap.org/');
    }

    public function index(string $place) {

        $search = $this->searchApi->newSearch();
        $search->query($place);

        $results = $this->searchApi->find($search);

        $list = [];
        foreach ($results as $result) {
            $list[] = [
                'type' => $result['type'],
                'address' => $result['display_name'],
                'osm_place_id' => $result['place_id'],
            ];
        }

        return view('search', [
            'place' => $place,
            'results' => $list,
        ]);
    }
}
