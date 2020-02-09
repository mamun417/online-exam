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
        $subjects = Subject::all();
        return view('frontend.study.select-subject', compact('subjects'));
    }

    public function selectSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required'
        ]);

        $study = [
            'student_id' => Auth::id(),
            'subject_id' => $request->subject_id
        ];

        Session::put('study', $study);

        return redirect()->route('study.question');
    }

    public function question()
    {
        $question = Question::WhereHas('template', function ($query) {
            $subject_id = Session::get('study')['subject_id'];
            $query->where('subject_id', $subject_id);
        })->active()->inRandomOrder()->take(1)->first();

        $question_options = $question->options;

        //dd($question->toArray(), $question_options->toArray());

        return view('frontend.study.question', compact('question', 'question_options'));
    }

    public function submitQuestion(Request $request){

        $request->validate([
            'question_id' => 'required',
            'options' => ''
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
        }else{
            Session::flash('error', 'Incorrect answer.');
        }
        return back();
    }
}
