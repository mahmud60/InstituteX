@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Classroom {{ App\Models\Course::where('id',$classid)->get()->first()->course_code }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>

                        <li><a href='/meeting?name={{Auth::user()->name}}&mn={{ $meeting->meeting_link }}&pwd={{ $meeting->password }}&role=1&signature={{ $meeting->signature }}' target="_blank">Join Video Lesson </a></li>

                        <li>Create a post</li>

                    </ul>
                    
                </div>

            </div> 

            <br>

            <div class="card">
                <div class="card-body">

                <form method="post" action="/games" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <!--input name="title" type="text" class="form-control" id="titleid" placeholder="Game Title"-->
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
@endsection
