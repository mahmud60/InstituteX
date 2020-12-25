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

            
        <link rel='stylesheet' href='css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
        <link rel="stylesheet" href="css/course.css">
        <link rel="stylesheet" href="css/nstyle.css">

        <style>
            body {
                background-image: url('img/home-bg.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed; 
                background-size: 100% 100%;
            }
        </style>

    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-mainbg">

            <a class="navbar-brand navbar-logo" href="/">{{ config('app.name', 'Laravel') }}</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                    <li class="nav-item active">
                        <a class="nav-link" href="/home"><i class="fas fa-tachometer-alt"></i>Home</a>
                    </li>
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
        <script src='js/bootstrap.min.js'></script>
        <script  src="js/nscript.js"></script>
  
    </body>
</html>
