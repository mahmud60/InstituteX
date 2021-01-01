<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

            
        <link rel='stylesheet' href="{{ asset('css/bootstrap.min.css') }}">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
        <link rel="stylesheet" href="{{ asset('css/nstyle.css') }}">

    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-mainbg">

            <a class="navbar-brand navbar-logo" href="/home">{{ config('app.name', 'Laravel') }}</a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                    <li class="nav-item {{ (request()->is('classroom/*/*/stream')) ? 'active' : '' }}">
                        <a class="nav-link" href="stream">Stream</a>
                    </li>
                    <li class="nav-item {{ (request()->is('classroom/*/*/people')) ? 'active' : '' }}">
                        <a class="nav-link" href="people">People</a>
                    </li>
                    <li class="nav-item {{ (request()->is('classroom/*/*/classwork')) ? 'active' : '' }}">
                        <a class="nav-link" href="classwork">Classwork</a>
                    </li>

                    @if($meeting!=null)
                        <li class="nav-item">
                            <a class="nav-link" id="meeting" href="meeting?name={{Auth::user()->name}}&mn={{ $meeting->meeting_link }}&pwd={{ $meeting->password }}&role=1&signature={{ $meeting->signature }}" role="tab" aria-controls="contact" aria-selected="false">Join Live Class</a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->user_type == 1)
                        <li class="nav-item {{ (request()->is('classroom/*/*/participation')) ? 'active' : '' }}">
                            <a class="nav-link" id="participation" href="participation" role="tab" aria-controls="contact" aria-selected="false">Participation</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            
        </nav>

        @yield('content')

        <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script  src="{{ asset('js/nscript.js') }}"></script>
        
        <script>
            $('#inputGroupFile01').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(cleanFileName);
            })
        </script>

