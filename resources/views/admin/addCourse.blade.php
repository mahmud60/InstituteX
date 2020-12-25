@extends('layouts.app')

@section('content')

<div class="container mt-5 text-center">
        <h2 class="mb-4">
            Import Course Excel Sheet
        </h2>

        <form action="{{ route('add-course') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import data</button>
        </form>
    </div>

@endsection