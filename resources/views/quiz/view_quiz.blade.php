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
        
        <div class="col-lg-8">
            <form method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">
                        Question 1 
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <p> <strong> {{ $questions->question }} </strong> </p>
                        </div>

                        <div class="row">                           
                            @foreach ($options = $questions->getOptions as $option)
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="hidden" name="questionid" value = "{{ $questions->id }}">
                                        <input type="radio" id="Options" name="option" value="{{ $option->option_text }}" 
                                                {{ ($questions->getResult($userid,$quiz->id,$questions->id)==$option->option_text)? "checked" : "" }}>
                                        <label for="Option">{{ $option->option_text }}</label>    
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <br>
                    <button type="submit" class="btn btn-success">Submit Answer</button>
                </div>

            </form>             
        </div>
    </div>
</div>

@endsection