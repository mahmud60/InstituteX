@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="row">
                @foreach(Auth::user()->classes as $class)
                
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-block">
                                <img src="http://localhost:8000/img/single_cource.png" width=358>
                                <h4 class="card-title"> {{ App\Models\Course::where('id',$class->course_id)->get()->first()->course_name }} </h4>

                                <p class="card-body">
                                    <a href="/classroom/{{ Auth::user()->id }}/{{ $class->course_id }}/stream"> {{ App\Models\Course::where('id',$class->course_id)->get()->first()->course_code }} </a>
                                </p>
                            </div>
                        </div>
                    </div>
                
                @endforeach
            </div>

                @if(Auth::user()->user_type==1)

                    @foreach(Auth::user()->coursesFaculty as $class)

                        <li><a href="/classroom/{{ Auth::user()->id }}/{{ $class->course_id }}/stream"> {{ App\Models\Course::where('id',$class->course_id)->get()->first()->course_code }} </a>

                    @endforeach

                @endif

    </div>
</div>
@endsection
