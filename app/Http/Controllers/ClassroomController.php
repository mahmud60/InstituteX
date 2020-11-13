<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassStudent;
use App\Models\Meeting;

class ClassroomController extends Controller
{
    public function class($userid, $id)
    {

        $student = (ClassStudent::where(['user_id' => $userid,'course_id' => $id])->get());

        if (ClassStudent::where(['user_id' => $userid,'course_id' => $id])->exists()) 
        {
            $res = Meeting::where('course_id',$id)->get()->first();
            $data = array(
                'userid' => $userid,
                'classid' => $id,
                'student' => $student,
                'meeting' => $res
            );
            return view ('/classroom/classroom')->with($data);
        }
        else 
        {
            return abort(404);
        }


    }
}
