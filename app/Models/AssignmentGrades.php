<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentGrades extends Model
{
    use HasFactory;

    protected $table = "assignment_grades";

    protected $fillable = [
        'user_id',
        'assignment_id',
        'marks',
    ];
}
