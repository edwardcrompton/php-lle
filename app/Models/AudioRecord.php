<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioRecord extends Model
{
    protected $table = 'audio_records';

    protected $fillable = ['audio_path', 'location_address'];
}
