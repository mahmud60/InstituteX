<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassStudent;
use App\Models\ClassFaculty;
use App\Models\Meeting;
use App\Models\Assignment;
use App\Models\Course;

class ClassWorkController extends Controller
{
    public function assignment($userid, $id)
    {
        $course = Course::find($id);
        $meeting = Meeting::where('course_id',$id)->get()->first();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting
        );

        return view('classroom.assignment')->with($data);
    }

    public function createAssignment($userid, $id)
    {
        $assignment = new Assignment;
        
        if(request('file')) {
            $fileName = time().'_'.request('file')->getClientOriginalName();
            $filePath = request('file')->storeAs('uploads', $fileName, 'public');
            $assignment->file_name = $fileName;
            $assignment->attachment = '/storage/' . $filePath;
        }

        $assignment->user_id = $userid ;
        $assignment->course_id = $id;
        $assignment->title = request('title');
        $assignment->instructions = request('instructions');
        $assignment->points = request('points');
        $assignment->due_date = request('due-date');
        $assignment->created_at = now();
        $assignment->save();
        return back();
    }
}
