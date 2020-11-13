<?php

use Illuminate\Support\Facades\Route;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
    //echo Meeting::all();
});

Route::get('/lessons/{username}', function($username){
    $user = User::where('name', $username)->firstOrFail();
    
    //$request = Request::create('/api/signature', 'GET');

    //$signature = Route::dispatch($request);

    return view('class');
    //dd($signature);
});

Route::get('/lesson', function () {
    return view('zoom');
});

Route::get('/class-lessons', function () {
    return view('class');
});

Route::get('/meeting', function (){
    return view('meeting/meeting');
});

Route::get('classroom/{userid}/{id}', 'App\Http\Controllers\ClassroomController@class');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('classroom/{userid}/{id}', 'App\Http\Controllers\ClassPostsController@createPost');
