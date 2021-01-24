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
                    <a class="nav-link {{ $active_tab == null || $active_tab == 'autograde' ? 'active' : '' }}" id="pills-assignment-tab" data-toggle="pill" href="#autograde" role="tab" aria-controls="pills-assignment" aria-selected="true">Auto-Grade Quizzes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active_tab == 'grade' ? 'active' : '' }}" id="pills-quizzes-tab" data-toggle="pill" href="#grade" role="tab" aria-controls="pills-quizzes" aria-selected="false">Grade Quizzes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active_tab == 'view-grades' ? 'active' : '' }}" id="pills-quizzes-tab" data-toggle="pill" href="#view-grades" role="tab" aria-controls="pills-quizzes" aria-selected="false">View Grades</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $active_tab == null || $active_tab == 'autograde' ? 'show active' : '' }}" id="autograde" role="tabpanel" aria-labelledby="assignment-tab">
                    <div class="col-lg-10 offset-lg-1">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form method="post" action="auto-grade" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    Auto-Grade Quiz
                                </div>
                                <div class="card-body">
                                    <div class="col-lg-6 offset-md-3">
                                        <div class="form-group"> 
                                            <div class="text-center">
                                                <label for="quiz">Select Quiz:</label>  
                                                <select name="quiz" class="form-control select">  
                                                @foreach($quizzes as $quiz)
                                                    <option value="{{ $quiz->id }}"> {{ $quiz->title }} </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>                            
                        </form>             
                     </div>
                </div>
                <div class="tab-pane fade {{ $active_tab == 'grade' ? 'show active' : '' }}" id="grade" role="tabpanel" aria-labelledby="quizzes-tab">
                    <div class="col-lg-10 offset-lg-1">
                        <form method="post" action="grade" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    Grade Quiz
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="quiz">Select Quiz:</label>  
                                                <select name="quiz" class="form-control select">  
                                                @foreach($quizzes as $quiz)
                                                    <option value="{{ $quiz->id }}"> {{ $quiz->title }} </option>
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
                                        <button type="submit" class="btn btn-primary">Show Answers</button>
                                    </div>
                                </div>
                            </div>                            
                        </form>
                        @if(session()->has('grade-message'))
                        <?php 
                            $studentId = session()->get('studentId');
                            $quizId = session()->get('quizId');
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
                                            <p><strong>Marks Obtained: </strong> {{ App\Models\Grade::where(['quiz_id' => $quizId, 'user_id' => $studentId])->get()->first()->marks }} </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        @if(session()->has('error-message'))
                            <br>
                            <div class="alert alert-warning">
                                {{ session()->get('error-message') }}
                            </div>
                        @endif
                    </div>
                    <br>
                    <div class="col-lg-12">
                        @if(session()->has('answers'))
                            
                            <?php
                                $answers = session()->get('answers');
                                $studentId = session()->get('studentId');
                                $quizId = session()->get('quiz');
                            ?>

                            <div class="card">
                                <div class="card-header">
                                    Student Information
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><strong>Name: </strong> {{ App\Models\User::where('id',$studentId)->get()->first()->name }} </p>
                                            <p><strong>Marks Obtained: </strong> {{ App\Models\Grade::where(['quiz_id' => $quizId, 'user_id' => $studentId])->get()->first()->marks }} </p>
                                        </div>
                                    </div>
                                    <form method="POST" action="grade-quiz" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="hidden" name="studentId" value="{{ $studentId }}">
                                                <input type="hidden" name="quiz" value="{{ $quizId }}">
                                                <input type="text" class="form-control" name="mark" placeholder="Mark">
                                            </div>
                                        </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Mark Quiz / Update Mark</button>
                                    </form>
                                </div>

                            </div>
                            <br>
                            @foreach($answers as $key=>$answer)
                                <?php
                                    $question = App\Models\Question::where('id',$answer->question_id)->get()->first();
                                ?>
                                <div class="card">
                                    <div class="card-header">
                                        Question {{ $loop->iteration }}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <p> <strong> {{  $question->question }} </strong> </p>
                                            <p> <strong> Mark: </strong> {{ $question->mark }} </p>
                                            <p> <strong> Correct Answer: </strong> {{ $question->getAnswer($question->id)}} </p>
                                        </div>

                                        <div class="row">                           
                                            @foreach ($options = $question->getOptions as $option)
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="radio" id="Options" name="{{ $key }}" value="{{ $option->option_text }}" 
                                                                {{ ($question->getResult($answer->user_id,$answer->quiz_id,$question->id)==$option->option_text)? "checked" : "" }}>
                                                        <label for="Option">{{ $option->option_text }}</label>    
                                                    </div>
                                                </div>
                                            @endforeach
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
                        <form method="post" action="view-grade" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    View Student Grades
                                </div>
                                <div class="card-body">
                                    <div class="col-lg-6 offset-md-3">
                                        <div class="form-group"> 
                                            <div class="text-center">
                                                <label for="quiz">Select Quiz:</label>  
                                                <select name="quiz" class="form-control select">  
                                                @foreach($quizzes as $quiz)
                                                    <option value="{{ $quiz->id }}"> {{ $quiz->title }} </option>
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
                                        <th scope="col">Quiz</th>
                                        <th scope="col">Marks Obtained</th>
                                        <th scope="col">Total Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ App\Models\User::where('id',$grade->user_id)->get()->first()->name }}</td>
                                            <td>{{ $grade->quiz_id }}</td>
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