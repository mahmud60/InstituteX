<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassFaculty extends Model
{
    use HasFactory;

    protected $table = "class_faculties";

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

}
