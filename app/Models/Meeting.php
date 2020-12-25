<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Meeting extends Eloquent
{
    public $timestamps = false;

    protected $fillable = [
        'course_id',
        'meeting_link',
        'signature',
        'password',
    ];
}
