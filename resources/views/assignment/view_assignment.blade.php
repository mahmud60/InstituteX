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
            <div class="card">
                <div class="card-header">
                    Assignment {{ $assignment->title}}
                </div>
                <div class="card-body">

                    <form method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}

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

                        <button type="submit" class="btn btn-primary">Submit Assignment</button>

                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Your Submission
                </div>
                @foreach ($submissions as $submission)
                
                <div class="card-body">     
                    <p> <a href="{{ $submission->attachment }}" target="_blank"> {{ $submission->file_name }} </a> </p>
                    <form method="post" action="delete-submission" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <hr>
                @endforeach
                
            </div>
        </div>
    </div>
</div>

@endsection