<!doctype html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <style>
        .panel-primary{
            border-color:#337ab7
        }

        .panel-body{
            padding:15px
        }
        .panel-heading{
            padding:10px 15px;
            border-bottom:1px solid transparent;
            border-top-left-radius:3px;
            border-top-right-radius:3px
        }
        .panel-heading{
            color:#fff;
            background-color:#337ab7;
            border-color:#337ab7
        }
        .panel-heading{
            color:#3c763d;
            background-color:#dff0d8;
            border-color:#d6e9c6
        }
        .panel-heading{
            color:#a94442;
            background-color:#f2dede;
            border-color:#ebccd1
        }
        .panel-heading{
            border-bottom:0
        }
        .panel-heading{
            padding:10px 15px;
            border-bottom:1px solid transparent;
            border-top-left-radius:3px;
            border-top-right-radius:3px
        }
        .panel-body{
            padding:15px
        }
        .panel-body{
            border-top:1px solid #bce8f1
        }
        .panel-body{
            border-top:1px solid #ddd
        }
        .panel-body{
            border-bottom:1px solid #ddd
        }

    </style>

</head>
<body>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            MY Calender    
        </div>
        <div class="panel-body" >
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>
</div>
</body>
</html>