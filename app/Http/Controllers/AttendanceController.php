<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Participation;
use App\Models\Attendance;
use App\Models\ClassStudent;

class AttendanceController extends Controller
{
    public function attendanceCalculation($userid,$id)
    {
        $required_time = request('participation-time');
        $classes = Participation::where(['course_id' => $id, 'user_id' => $userid])->get();
        //$participations = Participation::where('course_id',$id)->get();
        $students = ClassStudent::where('course_id', $id)->get();
        
        foreach($classes as $class)
        {
            foreach($students as $student)
            {
                $participation = Participation::where(['course_id' => $id, 'user_id' => $student->user_id, 'date' => $class->date])->get()->first();
                if($participation==null)
                {
                    $present = 'A';
                }
                else 
                {
                    if($participation->audio_time >= $required_time)
                    {
                        $present = 'P';
                    }
                }

                $attendance = Attendance::updateOrCreate(
                    ['user_id' => $student->user_id, 'course_id' => $id, 'date' => $class->date],
                    ['present' => $present]
                );
            }
        }

        /*foreach($participations as $participation)
        {
            if($participation->audio_time >= $required_time)
                $present = 1;
            else 
                $present = 0;
            $attendance = Attendance::updateOrCreate(
                ['user_id' => $participation->user_id, 'course_id' => $id, 'date' => $participation->date],
                ['present' => $present]
            );
        }*/
        return redirect()->back()->with('message', 'Attendance calculated successfully!');
    }
}
