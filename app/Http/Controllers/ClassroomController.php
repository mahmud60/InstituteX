<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassStudent;
use App\Models\ClassFaculty;
use App\Models\Meeting;
use App\Models\Post;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\AssignmentGrades;
use App\Models\Grades;
use App\Models\Participation;
use App\Models\Attendance;
use Calendar;
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
        $assignments = Assignment::where('course_id',$id)->orderBy('id','desc')->get();
        $quizzes = Quiz::where('course_id',$id)->orderBy('id','desc')->get();

        $events = [];
        $data = Assignment::all();
        if($data->count()){
           foreach ($data as $key => $value) {
             $events[] = Calendar::event(
                 $value->title,
                 true,
                 new \DateTime($value->created_at),
                 new \DateTime($value->due_date.' +1 day')
             );
           }
        }
        $calendar = Calendar::addEvents($events);

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting,
            'assignments' => $assignments,
            'quizzes' => $quizzes,
            'calendar' => $calendar,
            'event' => json_encode($events)
        );

        return view('/classroom/classwork')->with($data);
    }

    public function participation($userid, $id)
    {

        $course = Course::find($id);
        $meeting = Meeting::where('course_id',$id)->get()->first();
        $classes = Participation::where(['course_id' => $id, 'user_id' => $userid])->get();
        $students = ClassStudent::where('course_id',$id)->get();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting,
            'classes' => $classes,
            'students' => $students,
        );

        return view('/classroom/participation')->with($data);
    }

    public function grades($userid, $id)
    {

        $course = Course::find($id);
        $meeting = Meeting::where('course_id',$id)->get()->first();

        $assignments = Assignment::where('course_id', $id)->get();
        $quizzes = Quiz::where('course_id', $id)->get();
        $students = ClassStudent::where('course_id', $id)->get();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting,
            'assignments' => $assignments,
            'quizzes' => $quizzes,
            'students' => $students,
        );

        return view('/classroom/grades')->with($data);
    }
}
