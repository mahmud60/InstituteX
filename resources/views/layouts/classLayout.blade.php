<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <div class="mx-auto order-0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('classroom/*/*/stream')) ? 'active' : '' }}" id="stream" href="stream" role="tab" aria-controls="home" aria-selected="true">Stream</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('classroom/*/*/people')) ? 'active' : '' }}" id="people" href="people" role="tab" aria-controls="profile" aria-selected="false">People</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('classroom/*/*/classwork')) ? 'active' : '' }}" id="classwork" href="classwork" role="tab" aria-controls="profile" aria-selected="false">Classwork</a>
                            </li>

                            @if($meeting!=null)
                                <li class="nav-item">
                                    <a class="nav-link" id="meeting" href="meeting?name={{Auth::user()->name}}&mn={{ $meeting->meeting_link }}&pwd={{ $meeting->password }}&role=1&signature={{ $meeting->signature }}" role="tab" aria-controls="contact" aria-selected="false">Join Video Lesson</a>
                                </li>
                            @endif

                            @if(Auth::user()->user_type == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="grades" href="" role="tab" aria-controls="contact" aria-selected="false">Grades</a>
                                </li>
                            @endif
                            
                        </ul>
                    </div>
            
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
