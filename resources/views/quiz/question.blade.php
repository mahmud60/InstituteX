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

        @if($course->isFaculty($userid))
            <ul class="list-unstyled">
                <li><a href="assignment" class="show_form">Create Assignment</a></li>
                <br>
                <li><a href="">Create Material</a></li>
            </ul>
        
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="create-question" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">
                        Create Question
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" class="form-control" name="question" placeholder="Question">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"> 
                                    <label for="mark">Mark</label>    
                                    <input type="text" class="form-control" name="mark" placeholder="Mark">
                                </div>
                            </div>
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
                        </div>
                    </div>
                </div>
                <br>

                @for ($question=1; $question<=4; $question++)
                    <div class="card">
                        <div class="card-header">
                            {{ 'Question Option '.$question }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="question">Option Text</label>
                                <input type="text" class="form-control" name="{{ 'option_text_'.$question }}" placeholder="Option Text">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group"> 
                                        <input type="hidden" name="{{ 'correct_'.$question }}" value="0"/>
                                        <input type="checkbox" name="{{ 'correct_'.$question }}" value="1">
                                        <label for="correct"> Correct </labe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>                
                @endfor

                <button type="submit" class="btn btn-primary">Submit</button>


            </form>             
        </div>
        @endif
    </div>
</div>

@endsection