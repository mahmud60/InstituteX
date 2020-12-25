@extends('layouts.app')

@section('content')

<div class="container mt-5 text-center">
    @foreach($courses as $course)
        <h2 class="mb-4">
            {{ $course->id}}
        </h2>
    @endforeach
</div>

@endsection