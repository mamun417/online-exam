<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Question;
use App\Model\Subject;
use Auth;
use Illuminate\Http\Request;
use Session;

class StudyController extends Controller
{
    public function showSelectSubject()
    {
        //check is select any subject for study
        $question_paper_info = Session::get('question_paper_info');
        if ($question_paper_info){ return redirect()->route('question'); }

        $subjects = Subject::all();
        return view('frontend.study.select-subject', compact('subjects'));
    }

    public function submitQuestion(Request $request){

        $request->validate([
            'question_id' => 'required',
            'options' => 'required'
        ]);

        $student_answer = array_map('intval', $request->options);

        //get question correct answer
        $question = Question::find($request->question_id);
        $question_correct_answers = $question->correctAnswers;

        $correct_answers = [];
        foreach ($question_correct_answers as $answer){
            $correct_answers[] = $answer->id;
        }

        //check two array contain same element or not to know student given answer right or wrong
        sort($student_answer);
        sort($correct_answers);

        $answer = $student_answer == $correct_answers ? true : false;

        if ($answer){
            Session::flash('success', 'Your given answer is correct.');
            return back();
        }

        //if question answer not correct
        $question_options = $question->options;

        Session::flash('error', 'Incorrect answer.');
        return view('frontend.question.question',
            compact('question','question_options', 'student_answer', 'correct_answers')
        );
    }
}
