<?php

namespace App\Imports;

use App\Models\ClassFaculty;
use Maatwebsite\Excel\Concerns\ToModel;

use App\Models\User;
use App\Models\Course;

class FacultyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ClassFaculty([
            'user_id' => User::where('email',$row[4])->first()->id,
            'course_id' => Course::where('course_code',$row[1])->first()->id,
        ]);
    }
}
