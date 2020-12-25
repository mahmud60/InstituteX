<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassStudent;
use App\Models\ClassFaculty;
use App\Models\Meeting;
use App\Models\Post;
use App\Models\Course;

use Auth;

class ClassroomController extends Controller
{
    public function class($userid, $id)
    {

        $student = (ClassStudent::where(['user_id' => Auth::User()->id,'course_id' => $id])->get());
        $posts = Post::where('course_id',$id)->orderBy('id','desc')->get();
        $meeting = Meeting::where('course_id',$id)->get()->first();

        if (ClassStudent::where(['user_id' => Auth::User()->id,'course_id' => $id])->exists()) 
        {  
            $data = array(
                'userid' => $userid,
                'classid' => $id,
                'student' => $student,
                'posts' => $posts,
                'meeting' => $meeting
            );
            return view ('/classroom/stream')->with($data);
        }
        else if(ClassFaculty::where(['user_id' => Auth::User()->id,'course_id' => $id])->exists())
        {
            $data = array(
                'userid' => $userid,
                'classid' => $id,
                //'student' => $student,
                'posts' => $posts,
                'meeting' => $meeting
            );
            return view ('/classroom/stream')->with($data);
        }
        else 
        {
            return abort(404);
        }


    }

    public function people($userid, $id)
    {
        
        $course = Course::find($id);
        $meeting = Meeting::where('course_id',$id)->get()->first();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting
        );
        return view ('/classroom/people')->with($data);
    }

    public function classwork($userid, $id)
    {

        $course = Course::find($id);
        $meeting = Meeting::where('course_id',$id)->get()->first();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting
        );

        return view('/classroom/classwork')->with($data);
    }
}
