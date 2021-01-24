@extends('layouts.navigation.nav')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-lg-12">
            <br>
            <h2> {{ $course->getCourseName($courseid) }} </h2>
            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
            
            <br> </br>
        </div> 

        <?php 
            if(session()->has('active_tab'))
                $active_tab = session()->get('active_tab');
            else 
                $active_tab = null;
        ?>

        <div class="col-lg-10">

            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $active_tab == null || $active_tab == 'grade' ? 'active' : '' }}" id="pills-quizzes-tab" data-toggle="pill" href="#grade" role="tab" aria-controls="pills-quizzes" aria-selected="false">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active_tab == 'view-grades' ? 'active' : '' }}" id="pills-quizzes-tab" data-toggle="pill" href="#view-grades" role="tab" aria-controls="pills-quizzes" aria-selected="false">View Attendance</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $active_tab == null || $active_tab == 'grade' ? 'show active' : '' }}" id="grade" role="tabpanel" aria-labelledby="quizzes-tab">
                    <div class="col-lg-10 offset-lg-1">
                        <form method="post" action="calculate-attendance" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    Student Participation
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="assignment">Participation Time:</label>  
                                                <input type="text" class="form-control" name="participation-time" placeholder="Enter time in seconds here">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Calculate Attendance</button>
                                    </div>
                                </div>
                            </div>                            
                        </form>
                        @if(session()->has('message'))
                            <br>
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>                     
                </div>

                <div class="tab-pane fade {{ $active_tab == 'view-grades' ? 'show active' : '' }}" id="view-grades" role="tabpanel" aria-labelledby="material-tab">
                    <br>
                    <div class="col-lg-12">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Name</th>
                                    @foreach($classes as $class)
                                        <th scope="col">{{ $class->date }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <?php 
                                    $temps = App\Models\Attendance::where('user_id',$student->user_id)->get();
                                ?>
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ App\Models\User::where('id',$student->user_id)->get()->first()->name }}</td>
                                        @foreach($temps as $attendance)
                                            <td> {{ $attendance->present }} </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>

        </div>

@endsection