@extends('layouts.navigation.nav')

@section('content')
@push('links')
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
@endpush



<div class="col-lg-10 offset-md-1">
    <br>
    <h2> {{ $course->getCourseName($courseid) }} </h2>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    
    <br> </br>
</div> 


<div class="row">

    <div class="col-md-3 offset-md-1"> 
        <div id="calendar">

        </div>

        @if($course->isFaculty($userid))
        <br>
            <div class="card bg-light text-dark">

                <div class="card-header">
                    <strong>Classwork Tools</strong>
                    <br>                                    
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 offset-md-1">
                            <a href="assignment"><img src={{ asset('img/icon/assignment.png') }} width=50px title="Create Assignment"></a>
                            <br>
                            <p style="font-size:0.75vw">Assignment</p>
                        </div>
                        <div class="col-lg-4">
                            <a href="material"><img src={{ asset('img/icon/document.png') }} width=50px title="Create Material"></a>
                            <br>
                            <p style="font-size:0.75vw">Material</p>
                        </div>
                        <div class="col-lg-3">
                            <a href="quiz" target="_blank"><img src={{ asset('img/icon/test.png') }} width=50px title="Create Quiz"></a>
                            <br>
                            <p style="font-size:0.75vw">Quiz</p>
                        </div>
                        <div class="col-lg-4 offset-md-1">
                            <a href="create-question" target="_blank"><img src={{ asset('img/icon/questionnaire.png') }} width=40px title="Create Question"></a>
                            <br>
                            <p style="font-size:0.75vw">Question</p>
                        </div>
                        <div class="col-lg-4">
                            <a href="grade" target="_blank"><img src={{ asset('img/icon/grade-test.png') }} width=40px title="Grade Quiz"></a>
                            <br>
                            <p style="font-size:0.75vw">Grade Quiz</p>
                        </div>
                        <div class="col-lg-3">
                            <a href="grade-assignment" target="_blank"><img src={{ asset('img/icon/grade-test.png') }} width=40px title="Grade Assignment"></a>
                            <br>
                            <p style="font-size:0.75vw">Grade Assignment</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <div class="col-lg-8">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-assignment-tab" data-toggle="pill" href="#assignment" role="tab" aria-controls="pills-assignment" aria-selected="true">Assignments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-quizzes-tab" data-toggle="pill" href="#quizzes" role="tab" aria-controls="pills-quizzes" aria-selected="false">Quizzes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-material-tab" data-toggle="pill" href="#material" role="tab" aria-controls="pills-material" aria-selected="false">Materials</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="assignment" role="tabpanel" aria-labelledby="assignment-tab">

                            @foreach ($assignments as $assignment)
                        
                                <div class="card">
                                    <a href="view-assignment/{{ $assignment->id }}">
                                    <div class="card-header">
                                        <strong>Assignment: {{ $assignment->title }}</strong>
                                        <br>
                                        
                                    </div>
                                    </a>
                                    <div class="card-body"> 
                                        <p><small>Posted {{ $assignment->created_at->toDayDateTimeString() }} </small></p>
                                        @if($assignment->instructions!=null)
                                            <p> <strong> Instructions </strong></p>
                                            <p>{{ $assignment->instructions }} </p>
                                        @endif

                                        <p> <strong>Marks: </strong> {{ $assignment->points }} </p>
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
                        <div class="tab-pane fade" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">

                            @foreach ($quizzes as $quiz)
                                <?php
                                    $id = $quiz->id;
                                    $hashid = new Hashids\Hashids();
                                    $id =  $hashid->encode($id);
                                    $qid = $hashid->encode(0);
                                ?>
                                <div class="card">
                                    <a href="view-quiz/{{ $id }}/{{ $qid }}">
                                    <div class="card-header">
                                        <strong>Quiz: {{ $quiz->title }}</strong>
                                        <br>
                                        
                                    </div>
                                    </a>
                                    <div class="card-body"> 
                                        <p><small>Posted {{ $quiz->created_at->toDayDateTimeString() }} </small></p>

                                        <p> <strong>Marks: </strong> {{ $quiz->marks }} </p>
                                        <p> <strong>Date: </strong> {{ $quiz->date }} </p>
                                        <p> <strong>Start Time: </strong> {{ $quiz->start_time }} </p>
                                        <p> <strong>End Time: </strong> {{ $quiz->end_time }} </p>

                                        @if($assignment->file_name!=null)
                                            <p> <strong> Attachments </strong></p>
                                            <p> <a href="{{ $quiz->attachment }}" target="_blank"> {{ $quiz->file_name }} </a> </p>
                                        @endif

                                    </div>
                                </div>
                                <br>

                            @endforeach

                        </div>

                        <div class="tab-pane fade" id="material" role="tabpanel" aria-labelledby="material-tab">
                            
                        </div>
                    </div>

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

@push('script')


<script src="{{ asset('js/fullcalendar.js') }}"></script>
{!! $calendar->script() !!}

@endpush

@endsection

