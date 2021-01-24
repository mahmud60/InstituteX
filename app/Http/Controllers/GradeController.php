<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\QuizSubmission;
use App\Models\Grade;
use App\Models\QuestionOptions;
use App\Models\Question;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\ClassStudent;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\AssignmentGrades;

class GradeController extends Controller
{

    public function index($userid,$id)
    {
        $course = Course::find($id);
        $quizzes = Quiz::where('course_id',$id)->get();
        $students = ClassStudent::where('course_id',$id)->get();
        $active_tab = "autograde";
        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'quizzes' => $quizzes,
            'students' => $students,
            //'active_tab' => $active_tab
        );
        return view('grades.view')->with($data);
    }

    public function viewAssignments($userid,$id)
    {
        $course = Course::find($id);
        $assignments = Assignment::where('course_id',$id)->get();
        $students = ClassStudent::where('course_id',$id)->get();
        $data = array(
            'userid' => $userid,
            'courseid' => $id,
            'course' => $course,
            'assignments' => $assignments,
            'students' => $students,
        );
        return view('grades.grade_assignment')->with($data);
    }

    public function autoGrade()
    {
        $qid = request('quiz');
        $submissions = QuizSubmission::where('quiz_id', $qid)->get();

        foreach($submissions as $submission)
        {
            $answer = QuestionOptions::where(['question_id' => $submission->question_id,'correct' => '1'])->get()->first();
            
            $answer = $answer->option_text;
            //dd($answer);
            $mark = Grade::where(['user_id' => $submission->user_id, 'quiz_id' => $qid])->get()->first();
            if($mark != null)
                $mark = $mark->marks;
            $question_mark = Question::where('id',$submission->question_id)->get()->first();
            $question_mark = $question_mark->mark;
            if($mark==null)
                $mark = 0;
            if($answer==$submission->answer)
                $mark = $mark+$question_mark;
            $submitGrade = Grade::updateOrCreate(
                ['user_id' => $submission->user_id, 'quiz_id' => $qid],
                ['marks' => $mark]
            );
        }
        return redirect()->back()->with('message', 'Quiz Graded');
    }

    public function grade()
    {
        $qid = request('quiz');
        $studentId = request('studentId');

        $answers = QuizSubmission::where(['quiz_id' => $qid, 'user_id' => $studentId])->get();

        if($answers->isEmpty())
            return redirect()->back()->with(['error-message' => 'No result found!', 'active_tab' => 'grade']);
        else 
            return redirect()->back()->with(['answers' => $answers, 'studentId' => $studentId, 'quiz' => $qid, 'active_tab' => 'grade']);
    }

    public function gradeQuiz()
    {
        $qid = request('quiz');
        $studentId = request('studentId');
        $mark = request('mark');

        $grade = Grade::updateOrCreate(
            ['user_id' => $studentId, 'quiz_id' => $qid],
            ['marks' => $mark]
        );

        return redirect()->back()->with(['grade-message' => 'Quiz graded successfully!', 'active_tab' => 'grade', 'studentId' => $studentId, 'quizId' => $qid]);
        //return redirect()->back();
    }

    public function viewGrade()
    {
        $qid = request('quiz');
        $grades = Grade::where('quiz_id',$qid)->get();

        return redirect()->back()->with(['grades' => $grades, 'active_tab' => 'view-grades']);
    }

    public function gradeAssignment()
    {
        $assignmentId = request('assignment');
        $studentId = request('studentId');

        $submissions = Submission::where(['assignment_id' => $assignmentId, 'user_id' => $studentId])->get();

        return redirect()->back()->with(['active_tab' => 'grade', 'submissions' => $submissions, 'assignmentId' => $assignmentId, 'studentId' => $studentId]);
    }

    public function markAssignment()
    {
        $assignmentId = request('assignment');
        $studentId = request('studentId');
        $mark = request('mark');

        $grade = AssignmentGrades::updateOrCreate(
            ['user_id' => $studentId, 'assignment_id' => $assignmentId],
            ['marks' => $mark]
        );

        return redirect()->back()->with(['grade-message' => 'Assignment graded successfully!', 'active_tab' => 'grade', 'studentId' => $studentId, 'assignmentId' => $assignmentId]);
        
    }

    public function viewAssignment()
    {
        $assignmentId = request('assignment');
        $grades = AssignmentGrades::where('assignment_id',$assignmentId)->get();

        return redirect()->back()->with(['grades' => $grades, 'active_tab' => 'view-grades']);
    }
}
