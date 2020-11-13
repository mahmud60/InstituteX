@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Class Lessons') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>

                        @foreach(Auth::user()->classes as $class)

                            <li><a href="/classroom/{{ Auth::user()->id }}/{{ $class->course_id }}/"> {{ App\Models\Course::where('id',$class->course_id)->get()->first()->course_code }} </a></li>
                        
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
