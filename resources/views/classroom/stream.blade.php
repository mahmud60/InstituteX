@extends('layouts.navigation.nav')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>
            <div class="card">
                <div class="card-header">Classroom {{ App\Models\Course::where('id',$classid)->get()->first()->course_code }}</div>

            </div> 
            
            <div class="card">
                <div class="card-body">

                    <form method="post" action="" enctype="multipart/form-data" class="md-form">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="5" id="post-body" name="post-body" placeholder="Announce something to your class"></textarea>
                                <input type="hidden" name="course-id" value="{{ $classid }}">
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

                            <div class="offset-sm-5">
                                <br>
                                <button type="submit" class="btn btn-primary">Submit Post</button>
                            </div>

                        </div>
                    </form>

                </div>

            </div> <br>
            
            @foreach ($posts as $post)

                <div class="card">

                    <div class="card-body"> 

                        <p> <strong>{{ $post->getUsername->name }} </strong></p>

                        <p> <small> {{ $post->created_at->toDayDateTimeString() }} </small> </p>

                        <p> {{ $post->body }} </p>

                        @if($post->file_name!=null)
                            <p> <a href="{{ $post->attachment }}" target="_blank"> {{ $post->file_name }} </a> </p>
                        @endif

                    </div>

                    @if($post->hasPostFromUser($post->id, $userid))

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-outline-danger">Edit</button>
                        </div>

                        <br>

                        <form method="post" action="delete">
                            {{ csrf_field() }}
                            <div class="col-sm-2">
                                <input type="hidden" name="post-id" id="post-id" value="{{ $post->id }}">
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </div>
                        </form>

                    @endif

                    <hr>

                    @if($post->numberOfComments->count() > 0)

                        <div class="col-sm-2">
                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);" id="">
                                {{ $post->numberOfComments->count() }} 
                                @if($post->numberOfComments->count() > 1)
                                    comments
                                @else
                                    comment
                                @endif
                            </a>
                        </div><br>

                    @endif

                    @foreach ($comments = $post->getComments as $comment)
                        @if(!empty($comments))

                            <p class="col-sm-12"><strong> {{ $comment->getUsername->name }} </strong> <small> {{ $comment->created_at->toFormattedDateString() }} </small></p>
                            
                            <p class="col-sm-12">{{ $comment->comment }}</p>  

                            @if($comment->hasCommentFromUser($comment->id, $userid))

                                <button type="submit" class="btn btn-outline-danger btn-sm">Edit</button>

                                <form method="post" action="delete/comment">
                                    {{ csrf_field() }}
                                    <div class="col-sm-2">
                                        <input type="hidden" name="comment-id" id="comment-id" value="{{ $comment->id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </form>
                                <br>

                            @endif

                        @endif
                    @endforeach

                    @if($comments->count() > 0)
                        <hr>
                    @endif
                    
                    <div class="card-body">
                        <form method="post" action="comment">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows=1 id="comment" name="comment" placeholder="Add a comment"></textarea>
                                    <input type="hidden" name="post-id" id="post-id" value = "{{ $post->id }}">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-outline-secondary">Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <br>

            @endforeach


        </div>
    </div>
</div>


@endsection
