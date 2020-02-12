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
        if ($question_paper_info){ return redirect()->route('study.question'); }

        $subjects = Subject::all();
        return view('frontend.study.select-subject', compact('subjects'));
    }

    public function selectSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required'
        ]);

        $question_paper_info = [
            'question_paper_type' => 'study',
            'student_id' => Auth::id(),
            'subject_id' => $request->subject_id,
            'generated_question_ids' => [],
            'generated_question_count' => 0,
        ];

        Session::put('question_paper_info', $question_paper_info);
        return redirect()->route('study.question');
    }

    public function question()
    {
        $question_paper_info = Session::get('question_paper_info');

        //check is select any subject for study
        if ($question_paper_info == []){ return redirect()->route('study.select-subject'); }

        //check limit cross
        if ($question_paper_info['generated_question_count'] == 10){
            Session::flash('limit_cross', 'Dear '.Auth::user()->name.' '.Auth::user()->last_name.', it\'s time to finished your study.');
            return view('frontend.study.question');
        }

        $subject_id = $question_paper_info['subject_id'];
        $generated_question_ids = $question_paper_info['generated_question_ids'];

        //generate question
        $question = Question::WhereHas('template', function ($query) use ($subject_id) {
            $query->where('subject_id', $subject_id);
        })->whereNotIn('id', $generated_question_ids)->active()->inRandomOrder()->take(1)->first();

        //store question id to prevent generate same question
        array_push($question_paper_info['generated_question_ids'], $question->id);
        $question_paper_info['generated_question_count']++;
        Session::put('question_paper_info', $question_paper_info);

        $question_options = $question->options;
        $correct_answers = $student_answer = [];

        return view('frontend.study.question', compact('question', 'question_options', 'correct_answers', 'student_answer'));
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
        return view('frontend.study.question',
            compact('question','question_options', 'student_answer', 'correct_answers')
        );
    }

    public function finished(){
        Session::put('question_paper_info', []);
        return redirect()->route('study.select-subject')->with('success', 'Thank you '.Auth::user()->name.' '.Auth::user()->last_name.', Have a good day.');
    }
}
