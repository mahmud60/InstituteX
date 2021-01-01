@extends('layouts.navigation.nav')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-lg-12">
            <br>
            <h2> {{ $course->getCourseName($courseid) }} </h2>
            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
            
            <br> </br>
        </div> 

        @if($course->isFaculty($userid))
            <ul class="list-unstyled">
                <li><a href="assignment" class="show_form">Create Assignment</a></li>
                <br>
                <li><a href="">Create Material</a></li>
            </ul>
        @endif

        <div class="col-lg-8 offset-lg-2">
            @foreach ($assignments as $assignment)
            
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $assignment->title }}</strong>
                        <br>
                        <small> {{ $assignment->created_at->toDayDateTimeString() }} </small>
                    </div>

                    <div class="card-body"> 
                        
                        @if($assignment->instructions!=null)
                            <p> <strong> Instructions </strong></p>
                            <p>{{ $assignment->instructions }} </p>
                        @endif

                        <p> <strong>Points: </strong> {{ $assignment->points }} </p>
                        <p> <strong> Due Date: </strong> {{ $assignment->due_date }} </p>

                        @if($assignment->file_name!=null)
                            <p> <strong> Attachments </strong></p>
                            <p> <a href="{{ $assignment->attachment }}" target="_blank"> {{ $assignment->file_name }} </a> </p>
                        @endif

                    </div>
                </div>
                <br>

            @endforeach
        </div>


        <div id="form_wrapper" style="display:none;">
            <form id="contactus" action="javascript:submit_form()" method="post" accept-charset="UTF-8">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="5" id="post-body"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-sm-5 col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit Post</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

<!--
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script>
    $('a.show_form').on('click', function() {
    $('#form_wrapper').show();
    });
</script>
-->

@endsection

