<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AudioRecord extends Model
{
    protected $table = 'audio_records';

    protected $fillable = ['audio_path', 'location_address'];

    public function getUpdatePath() {
        return route(
            'record', 
            ['location' => $this->location_address, 'locale' => app()->getLocale()],
        );
    }
}
