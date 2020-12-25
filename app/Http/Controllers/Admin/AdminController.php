<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CourseImport;
use App\Imports\FacultyImport;
use App\Models\ClassFaculty;
use App\Models\Meeting;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function addCourse()
    {
        return view('admin.addCourse');
    }

    public function addCourseToDb(Request $request)
    {
        Excel::import(new CourseImport, $request->file('file')->store('temp'));
        Excel::import(new FacultyImport, $request->file('file')->store('temp'));

        return back();
    }

    public function addFaculty()
    {
        return view('admin.addFaculty');
    }

    public function addFacultyToDb(Request $request)
    {
        Excel::import(new FacultyImport, $request->file('file')->store('temp'));
        return back();
    }

    public function createClassroom()
    {
        //return view('admin.createClassroom');
        $courses = ClassFaculty::all();

        foreach($courses as $course)
        {
            $request = Request::create('/api/meetings', 'POST');
            $response = Route::dispatch($request);

            $data = $response->getOriginalContent();

            $courseId = $course->id;

            foreach($data as $info)
            {
                $meetingId = $info['id'];
                $password = $info['password'];
            }

            $signatureRequest = Request::create('/api/signature/'.$meetingId, 'GET');
            $signature = Route::dispatch($signatureRequest);
            $signature = $signature->getOriginalContent();
            //dd($signature->getOriginalContent());

            $meeting = new Meeting();
            $meeting->course_id = $courseId;
            $meeting->meeting_link = $meetingId;
            $meeting->signature = $signature;
            $meeting->password = $password;
            $meeting->save();
        }

        /*$data = array(
            'courses' => $courses,
        );
        //return view('admin.createClassroom')->with($data);*/
    }

}
