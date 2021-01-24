<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hashids\Hashids;
use Session;

use App\Models\ClassStudent;
use App\Models\ClassFaculty;
use App\Models\Meeting;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Course;
use App\Events\EventModel;
use App\Models\Submission;
use App\Models\QuestionOptions;
use App\Models\QuizSubmission;


class ClassWorkController extends Controller
{

    public function assignment($userid, $id)
    {
        $course = Course::find($id);
        $meeting = Meeting::where('course_id',$id)->get()->first();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting,
        );

        return view('classroom.assignment')->with($data);
    }

    public function quiz($userid, $id)
    {
        $course = Course::find($id);
        $meeting = Meeting::where('course_id',$id)->get()->first();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'meeting' => $meeting,
        );

        return view('classroom.quiz')->with($data);
    }

    public function createAssignment($userid, $id)
    {
        $assignment = new Assignment;
        
        if(request('file')) {
            $fileName = time().'_'.request('file')->getClientOriginalName();
            $filePath = request('file')->storeAs('uploads', $fileName, 'public');
            $assignment->file_name = $fileName;
            $assignment->attachment = '/storage/' . $filePath;
        }

        $assignment->user_id = $userid ;
        $assignment->course_id = $id;
        $assignment->title = request('title');
        $assignment->instructions = request('instructions');
        $assignment->points = request('points');
        $assignment->due_date = request('due-date');
        $assignment->created_at = now();
        $assignment->save();
        return back();
    }

    public function createQuiz($userid, $id)
    {
        $quiz = new Quiz;
        
        if(request('file')) {
            $fileName = time().'_'.request('file')->getClientOriginalName();
            $filePath = request('file')->storeAs('uploads', $fileName, 'public');
            $quiz->file_name = $fileName;
            $quiz->attachment = '/storage/' . $filePath;
        }

        $quiz->user_id = $userid ;
        $quiz->course_id = $id;
        $quiz->title = request('title');
        $quiz->marks = request('marks');
        $quiz->date = request('date');
        $quiz->start_time = request('start-time');
        $quiz->end_time = request('end-time');
        $quiz->created_at = now();
        $quiz->save();
        return back();
    }

    /*public function showCalendar()
    {
        $events = [];
        $data = Assignment::all();
        if($data->count()){
           foreach ($data as $key => $value) {
             $events[] = Calendar::event(
                 $value->title,
                 true,
                 new \DateTime($value->created_at),
                 new \DateTime($value->due_date.' +1 day')
             );
           }
        }
        $calendar = Calendar::addEvents($events); 

        return view(('calendar'), compact('calendar'));
    }*/

    public function viewAssignment($userid,$id,$assignmentId)
    {
        $course = Course::find($id);
        $assignment = Assignment::where('id',$assignmentId)->get()->first();
        $submission = Submission::where(['user_id' => $userid,'course_id' => $id,'assignment_id' => $assignmentId])->orderBy('id','desc')->get();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'assignment' => $assignment,
            'submissions' => $submission
        );

        return view('assignment.view_assignment')->with($data);
    }

    public function question($userid,$id)
    {
        $course = Course::find($id);
        $quizzes = Quiz::where('course_id',$id)->get();
        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'quizzes' => $quizzes,
        );

        return view('quiz.question')->with($data);
    }

    public function createQuestion($userid,$id)
    {
        $question = new Question;
        
        $question->user_id = $userid ;
        $question->course_id = $id;
        $question->question = request('question');
        $question->mark = request('mark');
        $question->quiz_id = request('quiz');
        $question->created_at = now();
        $question->save();

        for ($q=1; $q <= 4; $q++) {
            $option = request('option_text_' . $q, '');
            if ($option != '') {
                $question_options = new QuestionOptions;

                $question_options->question_id = $question->id;
                $question_options->option_text = $option;
                $question_options->correct = request('correct_'.$q);
                $question_options->save();
            }
        }

        return back();
    }

    public function viewQuiz($userid,$id,$quizId,$qid)
    {
        $hashids = new Hashids();
        $quizId = $hashids->decode($quizId);
        $qid = $hashids->decode($qid);
        $q = intval($qid);
        $course = Course::find($id);
        $quiz = Quiz::where('id',$quizId)->get()->first();
        $questions = Session::get('questions');
        if($questions==null)
        {
            $questions = Question::where('quiz_id',$quizId)->inRandomOrder()->get();
            Session::put('questions',$questions);
        }
        
        
        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'quiz' => $quiz,
            'q' => $questions,
            'questions' => $questions[$qid[0]]
        );
        //dd($qid);
        return view('quiz.view_quiz')->with($data);
    }

    /*public function viewQuizQuestion($userid,$id,$quizId,$qid)
    {
        $course = Course::find($id);
        $quiz = Quiz::where('id',$quizId)->get()->first();
        //$question = Question::where('id',$qid)->get();

        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'quiz' => $quiz,
            'questions' => $this->questions[1]
        );

        return view('quiz.view_quiz')->with($data);
    }*/

    public function submitQuiz($userid,$id,$quizId,$qid)
    {
        $hashids = new Hashids();
        $qid = $hashids->decode($qid);
        $qid = $qid[0]+1;       
        $qid = $hashids->encode($qid);
        $quizId = $hashids->decode($quizId);
        $quizId = intval($quizId);
        //dd($quizId);
        $quizsubmission = new QuizSubmission;
        $quizsubmission->user_id = $userid;
        $quizsubmission->quiz_id = $quizId;
        $quizsubmission->question_id = request('questionid');
        $quizsubmission->answer = request('option');
        $quizsubmission->save();

        //$course = Course::find($id);
        //$quiz = Quiz::where('id',$quizId)->get()->first();
        /*$q = Question::where('quiz_id',$quizId)->get();
        
        foreach($q as $key => $question) 
        {
            $quizsubmission = new QuizSubmission;
            $quizsubmission->user_id = $userid;
            $quizsubmission->quiz_id = $quizId;
            $quizsubmission->question_id = request('question'.$key);
            $quizsubmission->answer = request($key);
            $quizsubmission->save();
        }
        

        return back();*/
        return redirect()->route('quiz', ['userid' => $userid, 'id' => $id, 'quizId' => $hashids->encode($quizId), 'qid' => $qid]);
    }

    public function submitAssignment($userid,$id,$assignmentId)
    {
        $submission = new Submission;
            
        if(request('file')) {
            $fileName = time().'_'.request('file')->getClientOriginalName();
            $filePath = request('file')->storeAs('uploads', $fileName, 'public');
            $submission->file_name = $fileName;
            $submission->attachment = '/storage/' . $filePath;
        }

        $submission->user_id = $userid ;
        $submission->course_id = $id;
        $submission->assignment_id = $assignmentId;
        //$submission->points = request('points');
        $submission->created_at = now();
        $submission->save();
        return back();
    }
}
