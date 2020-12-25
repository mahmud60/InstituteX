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

Route::get('classroom/{userid}/{id}/meeting', function (){
    return view('meeting/meeting');
});


Auth::routes();



Route::post('classroom/{userid}/{id}/stream', 'App\Http\Controllers\ClassPostsController@createPost');

Route::post('classroom/{userid}/{id}/delete', 'App\Http\Controllers\ClassPostsController@deletePost');

Route::post('classroom/{userid}/{id}/comment', 'App\Http\Controllers\ClassPostsController@addComment');

Route::post('classroom/{userid}/{id}/delete/comment', 'App\Http\Controllers\ClassPostsController@deleteComment');


Route::post('classroom/{userid}/{id}/participation/audio', 'App\Http\Controllers\ClassParticipationController@participate');

