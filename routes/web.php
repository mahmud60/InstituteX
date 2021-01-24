<?php

use Illuminate\Support\Facades\Route;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('index');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Admin routes
Route::get('/admin','App\Http\Controllers\Admin\AdminController@index')->name('admin');

Route::get('/admin/add-course','App\Http\Controllers\Admin\AdminController@addCourse');
Route::post('/admin/add-course', 'App\Http\Controllers\Admin\AdminController@addCourseToDb')->name('add-course');

Route::get('/admin/add-faculty', 'App\Http\Controllers\Admin\AdminController@addFaculty');
Route::post('/admin/add-faculty', 'App\Http\Controllers\Admin\AdminController@addFacultyToDb')->name('add-faculty');

Route::get('/admin/create-classroom', 'App\Http\Controllers\Admin\AdminController@createClassroom');


// Classroom routes
Route::get('classroom/{userid}/{id}/stream', 'App\Http\Controllers\ClassroomController@class');

Route::get('classroom/{userid}/{id}/people', 'App\Http\Controllers\ClassroomController@people');

Route::get('classroom/{userid}/{id}/classwork', 'App\Http\Controllers\ClassroomController@classwork');

Route::get('classroom/{userid}/{id}/participation', 'App\Http\Controllers\ClassroomController@participation');

Route::get('classroom/{userid}/{id}/grades', 'App\Http\Controllers\ClassroomController@grades');

Route::get('classroom/{userid}/{id}/meeting', function (){
    return view('meeting/meeting');
});

//Route::get('calendar', 'App\Http\Controllers\ClassWorkController@showCalendar');

//assignment routes

Route::get('classroom/{userid}/{id}/assignment', 'App\Http\Controllers\ClassWorkController@assignment');
Route::post('classroom/{userid}/{id}/create-assignment', 'App\Http\Controllers\ClassWorkController@createAssignment');

Route::get('classroom/{userid}/{id}/view-assignment/{assignmentId}','App\Http\Controllers\ClassWorkController@viewAssignment');
Route::post('classroom/{userid}/{id}/view-assignment/{assignmentId}','App\Http\Controllers\ClassWorkController@submitAssignment');

//quiz routes
Route::get('classroom/{userid}/{id}/quiz', 'App\Http\Controllers\ClassWorkController@quiz');
Route::post('classroom/{userid}/{id}/create-quiz', 'App\Http\Controllers\ClassWorkController@createQuiz');

Route::get('classroom/{userid}/{id}/view-quiz/{quizId}/{qid}',['as' => 'quiz', 'uses' =>'App\Http\Controllers\ClassWorkController@viewQuiz']);
//Route::get('classroom/{userid}/{id}/view-quiz/{quizId}/{qid}','App\Http\Controllers\ClassWorkController@viewQuizQuestion');
Route::post('classroom/{userid}/{id}/view-quiz/{quizId}/{qid}','App\Http\Controllers\ClassWorkController@submitQuiz');

Route::get('classroom/{userid}/{id}/create-question','App\Http\Controllers\ClassWorkController@question');
Route::post('classroom/{userid}/{id}/create-question','App\Http\Controllers\ClassWorkController@createQuestion');

Auth::routes();



Route::post('classroom/{userid}/{id}/stream', 'App\Http\Controllers\ClassPostsController@createPost');

Route::post('classroom/{userid}/{id}/delete', 'App\Http\Controllers\ClassPostsController@deletePost');

Route::post('classroom/{userid}/{id}/comment', 'App\Http\Controllers\ClassPostsController@addComment');

Route::post('classroom/{userid}/{id}/delete/comment', 'App\Http\Controllers\ClassPostsController@deleteComment');


Route::post('classroom/{userid}/{id}/participation/audio', 'App\Http\Controllers\ClassParticipationController@participate');

Route::get('classroom/{userid}/{id}/grade/', 'App\Http\Controllers\GradeController@index');
Route::get('classroom/{userid}/{id}/grade-assignment', 'App\Http\Controllers\GradeController@viewAssignments');

Route::post('classroom/{userid}/{id}/auto-grade', 'App\Http\Controllers\GradeController@autoGrade');
Route::post('classroom/{userid}/{id}/grade', 'App\Http\Controllers\GradeController@grade');
Route::post('classroom/{userid}/{id}/view-grade', 'App\Http\Controllers\GradeController@viewGrade');
Route::post('classroom/{userid}/{id}/grade-quiz', 'App\Http\Controllers\GradeController@gradeQuiz');

Route::post('classroom/{userid}/{id}/grade-assignment', 'App\Http\Controllers\GradeController@gradeAssignment');
Route::post('classroom/{userid}/{id}/mark-assignment', 'App\Http\Controllers\GradeController@markAssignment');
Route::post('classroom/{userid}/{id}/view-assignmentGrades', 'App\Http\Controllers\GradeController@viewAssignment');

Route::post('classroom/{userid}/{id}/calculate-attendance', 'App\Http\Controllers\AttendanceController@attendanceCalculation');