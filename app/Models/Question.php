<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizSubmission;
use App\Models\QuestionOptions;

class Question extends Model
{
    use HasFactory;

    /*$questions = null;

    public function getQuestions($quizid)
    {
        if($questions==null)
        {
            $questions = Question::where('quiz_id',$quizid)->get();
        }
        return $questions;
    }*/

    public function getOptions()
    {
        return $this->hasMany('App\Models\QuestionOptions','question_id')->inRandomOrder();
    }

    public function getResult($userid,$quizid,$questionid)
    {
        $result = QuizSubmission::where(['user_id' => $userid,'quiz_id' => $quizid,'question_id' => $questionid])->get()->first();
        if ($result != null)
            return $result->answer;
    }

    public function getAnswer($questionid)
    {
        $answer = QuestionOptions::where(['question_id' => $questionid, 'correct' => '1'])->get()->first();
        return $answer->option_text;
    }
}
