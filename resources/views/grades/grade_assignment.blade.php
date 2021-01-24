@extends('layouts.navigation.assignment')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-lg-12">
            <br>
            <h2> {{ $course->getCourseName($courseid) }} </h2>
            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
            
            <br> </br>
        </div> 

        <?php 
            if(session()->has('active_tab'))
                $active_tab = session()->get('active_tab');
            else 
                $active_tab = null;
        ?>

        <div class="col-lg-10">

            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $active_tab == null || $active_tab == 'grade' ? 'active' : '' }}" id="pills-quizzes-tab" data-toggle="pill" href="#grade" role="tab" aria-controls="pills-quizzes" aria-selected="false">Grade Assignments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active_tab == 'view-grades' ? 'active' : '' }}" id="pills-quizzes-tab" data-toggle="pill" href="#view-grades" role="tab" aria-controls="pills-quizzes" aria-selected="false">View Grades</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $active_tab == null || $active_tab == 'grade' ? 'show active' : '' }}" id="grade" role="tabpanel" aria-labelledby="quizzes-tab">
                    <div class="col-lg-10 offset-lg-1">
                        <form method="post" action="grade-assignment" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    Grade Assignment
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="assignment">Select Assignment:</label>  
                                                <select name="assignment" class="form-control select">  
                                                @foreach($assignments as $assignment)
                                                    <option value="{{ $assignment->id }}"> {{ $assignment->title }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="studentId">Select Student:</label>  
                                                <select name="studentId" class="form-control select">  
                                                @foreach($students as $student)
                                                    <option value="{{ $student->user_id }}"> {{ App\Models\User::where('id',$student->user_id)->get()->first()->name }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">View Assignment</button>
                                    </div>
                                </div>
                            </div>                            
                        </form>
                        @if(session()->has('grade-message'))
                        <?php 
                            $studentId = session()->get('studentId');
                            $assignmentId = session()->get('assignmentId');
                        ?>
                            <br>
                            <div class="alert alert-success">
                                {{ session()->get('grade-message') }}
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Student Information
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><strong>Name: </strong> {{ App\Models\User::where('id',$studentId)->get()->first()->name }} </p>
                                            <p><strong>Marks Obtained: </strong> {{ App\Models\AssignmentGrades::where(['assignment_id' => $assignmentId, 'user_id' => $studentId])->get()->first()->marks }} </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                    <br>
                    <div class="col-lg-12">
                        @if(session()->has('submissions'))
                            
                            <?php
                                $submissions = session()->get('submissions');
                                $studentId = session()->get('studentId');
                                $assignmentId = session()->get('assignmentId');
                                $grade = App\Models\AssignmentGrades::where(['assignment_id' => $assignmentId, 'user_id' => $studentId])->get()->first();
                                if($grade==null)
                                {
                                    $marks = "Ungraded";
                                }
                                else 
                                {
                                    $marks = $grade->marks;
                                }
                            ?>

                            <div class="card">
                                <div class="card-header">
                                    Student Information
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><strong>Name: </strong> {{ App\Models\User::where('id',$studentId)->get()->first()->name }} </p>
                                            <p><strong>Marks Obtained: </strong> {{ $marks }} </p>
                                        </div>
                                    </div>
                                    <form method="POST" action="mark-assignment" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="hidden" name="studentId" value="{{ $studentId }}">
                                                <input type="hidden" name="assignment" value="{{ $assignmentId }}">
                                                <input type="text" class="form-control" name="mark" placeholder="Mark">
                                            </div>
                                        </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Mark Assignment / Update Mark</button>
                                    </form>
                                </div>

                            </div>
                            <br>
                            @foreach($submissions as $key=>$submission)
                                <div class="card">
                                    <div class="card-header">
                                        Submission {{ $loop->iteration }}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <p> <strong> Assignment Title </strong> {{ App\Models\Assignment::where('id',$assignmentId)->get()->first()->title }} </p>
                                            <p> <strong> Submitted On: </strong> {{ $submission->created_at }} </p>
                                            <p> <strong> Attachment: </strong> <a href="{{ $submission->attachment }}"> {{ $submission->file_name }} </a> </p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach

                        @endif
                    </div>                      
                </div>

                <div class="tab-pane fade {{ $active_tab == 'view-grades' ? 'show active' : '' }}" id="view-grades" role="tabpanel" aria-labelledby="material-tab">
                    <div class="col-lg-10 offset-lg-1">
                        <form method="post" action="view-assignmentGrades" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    View Student Grades
                                </div>
                                <div class="card-body">
                                    <div class="col-lg-6 offset-md-3">
                                        <div class="form-group"> 
                                            <div class="text-center">
                                                <label for="assignment">Select Assignment:</label>  
                                                <select name="assignment" class="form-control select">  
                                                @foreach($assignments as $assignment)
                                                    <option value="{{ $assignment->id }}"> {{ $assignment->title }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Show Grades</button>
                                    </div>
                                </div>
                            </div>                            
                        </form>
                    </div> 
                    <br>
                    <div class="col-lg-12">
                        @if(session()->has('grades'))
                        <?php
                            $grades = session()->get('grades');
                        ?>

                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Assignment</th>
                                        <th scope="col">Marks Obtained</th>
                                        <th scope="col">Total Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ App\Models\User::where('id',$grade->user_id)->get()->first()->name }}</td>
                                            <td>{{ $grade->assignment_id }}</td>
                                            <td>{{ $grade->marks }}</td>
                                            <td>10</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div> 
                </div>
            </div>

        </div>

@endsection