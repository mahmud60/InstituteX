<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Course extends Eloquent
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'course_name',
        'course_code',
        'schedule',
    ];

    public function hasStudents()
    {
        return $this->hasMany('App\Models\ClassStudent','course_id');
    }

    public function getStudent($userid)
    {
        return User::where('id',$userid)->get()->first()->name;
    }

    public function getFaculty($courseid)
    {
        //return $this->belongsTo('App\Models\ClassFaculty','course_id');
        $facultyid = ClassFaculty::where('course_id',$courseid)->get()->first()->user_id;

        return User::where('id',$facultyid)->get()->first()->name;
    }

    public function getCourseName($coursid)
    {
        return $this->get()->find($coursid)->course_name;
    }

    public function getCourseCode($coursid)
    {
        return $this->get()->find($coursid)->course_code;
    }

    public function isFaculty($id)
    {
        $res = ClassFaculty::where('user_id', $id)->get();

        if($res->isEmpty())
            return false;
        else 
            return true;
    }

}
