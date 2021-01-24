@extends('layouts.navigation.assignment')

@section('content')

<div class="col-lg-10 offset-md-1">
    <br>
    <h2> {{ $course->getCourseName($courseid) }} </h2>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    
    <br>
</div>

@if($course->isFaculty($userid))
<div class="row">
    <div class="col-md-3 offset-md-1">
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
                        <p>Assignment</p>
                    </div>
                    <div class="col-lg-4">
                        <a href="material"><img src={{ asset('img/icon/document.png') }} width=50px title="Create Material"></a>
                        <br>
                        <p>Material</p>
                    </div>
                    <div class="col-lg-3">
                        <a href="test" target="_blank"><img src={{ asset('img/icon/test.png') }} width=50px title="Create Quiz"></a>
                        <br>
                        <p>Quiz</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="container">
            
                <div class="card">
                    <div class="card-header">
                        Create Quiz
                    </div>
                    <div class="card-body">
                        <form method="post" action="create-quiz" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title*</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>
                            <!--div class="form-group">
                                <textarea class="form-control" rows="5" name="instructions" placeholder="Instructions (optional)"></textarea>
                            </div-->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="points">Marks</label>     
                                        <input type="text" class="form-control" name="marks" placeholder="Marks">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group"> 
                                        <label for="points">Date</label>    
                                        <input type="date" class="form-control" name="date" placeholder="Due Date">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">                                 
                                    <div class="form-group"> 
                                        <label for="start-time">Start Time</label>    
                                        <input type="time" class="form-control" name="start-time">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group"> 
                                        <label for="end-time">End Time</label>    
                                        <input type="time" class="form-control" name="end-time">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>          
    </div>
</div>

@endif
@endsection
