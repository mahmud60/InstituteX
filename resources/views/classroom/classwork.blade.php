@extends('layouts.classLayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        @if($course->isFaculty($userid))
            <div class="col-md-8">
                <button type="submit">Create</button>
            </div>
            <br><br>
        @endif

        <div class="col-md-8">
            <h2> {{ $course->getCourseName($courseid) }} </h2>
            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
            
            <br> </br>
        </div> 

        

    </div>
</div>

@endsection