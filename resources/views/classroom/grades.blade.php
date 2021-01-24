@extends('layouts.navigation.nav')

@section('content')


<div class="col-lg-10 offset-md-1">
    <br>
    <h2> {{ $course->getCourseName($courseid) }} </h2>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    
    <br> </br>
</div> 


<div class="row">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            @foreach($assignments as $assignment)
                                <th scope="col">{{ $assignment->title }}</th>
                            @endforeach
                            @foreach($quizzes as $quiz)
                                <th scope="col">{{ $quiz->title }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <th scope="row">{{ App\Models\User::where('id', $student->user_id)->get()->first()->name }}</th>
                                @foreach ($assignments as $assignment)
                                    <?php
                                        $assignmentGrade = App\Models\AssignmentGrades::where(['assignment_id' => $assignment->id, 'user_id' => $student->user_id])->get()->first();
                                        if($assignmentGrade == null)
                                            $marks = 0;
                                        else 
                                            $marks = $assignmentGrade->marks;
                                    ?>
                                    <td>{{ $marks }} / {{ $assignment->points }}</td>
                                @endforeach
                                @foreach ($quizzes as $quiz)
                                    <?php
                                        $quizGrade = App\Models\Grade::where(['quiz_id' => $quiz->id, 'user_id' => $student->user_id])->get()->first();
                                        if($quizGrade == null)
                                            $quizMarks = 0;
                                        else 
                                            $quizMarks = $quizGrade->marks;
                                    ?>
                                    <td>{{ $quizMarks }} / {{ $quiz->marks }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection