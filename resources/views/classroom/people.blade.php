@extends('layouts.navigation.nav')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <br>
            <h2> Faculty </h2>
            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
            <p>{{ $course->getFaculty($courseid) }} </p>
            <br> </br>
        </div> 

        
        <div class="col-md-8">
            <h2> Students </h2>
            <hr style="height:1px;border-width:0;color:gray;background-color:gray">

            @foreach($students = $course->hasStudents()->get() as $student)
                @if(!empty($students))
                    <p> {{ $course->getStudent($student->user_id) }} </p>
                    <hr>
                @endif
            @endforeach

        </div>

    </div>

@endsection