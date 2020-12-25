<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    public $timestamps = false;

    protected $table = 'participation';

    protected $fillable = [
        'date',
        'course_id',
        'user_id',
        'audio_time',
    ];
}
