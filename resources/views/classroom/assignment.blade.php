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
        
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    Create Assignment
                </div>
                <div class="card-body">

                    <form method="post" action="create-assignment" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="instructions" placeholder="Instructions (optional)"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">     
                                    <input type="text" class="form-control" name="points" placeholder="Marks">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">     
                                    <input type="datetime-local" class="form-control" name="due-date" placeholder="Due Date">
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

        @endif
    </div>
</div>

@endsection

