<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!--Links -->
        <link rel='stylesheet' href="{{ asset('css/bootstrap.min.css') }}">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css">
        <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="{{ asset('css/nstyle.css') }}">
        @stack('links')


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script  src="{{ asset('js/nscript.js') }}"></script>
        @stack('script')   

        <style>
            .datepicker,
            .timepicker,
            .datetimepicker {
                .form-control {
                    background: #fff;
                }
            }
        </style> 
 
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-mainbg">

            <a class="navbar-brand navbar-logo" href="/home">{{ config('app.name', 'Laravel') }}</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>

        </nav>

        @yield('content')


        <script>
            $('#inputGroupFile01').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(cleanFileName);
            })
        </script>

