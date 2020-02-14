<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Examination;
use App\Model\Question;
use App\Model\Subject;
use Auth;
use Illuminate\Http\Request;
use Session;

class PracticeController extends Controller
{
    public function showSelectSubject()
    {
        $question_paper_info = Session::get('question_paper_info');
        if ($question_paper_info and $question_paper_info['question_paper_type'] == 'practice'){
            return redirect()->route('practice.question');
        }

        $subjects = Subject::all();
        return view('frontend.practice.select-subject', compact('subjects'));
    }

    public function selectSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'question_quantity' => 'required'
        ]);

        $examination = Examination::create([
            'user_id' => Auth::id(),
            'subject_id' => $request->subject_id,
        ]);

        $question_paper_info = [
            'question_paper_type' => 'practice',
            'examination_id' => $examination->id,
            'student_id' => Auth::id(),
            'subject_id' => $request->subject_id,
            'generated_question_ids' => [],
            'question_quantity' => $request->question_quantity
        ];

        Session::put('question_paper_info', []);
        Session::put('question_paper_info', $question_paper_info);
        return redirect()->route('practice.question');
    }

    public function question()
    {
        $question_paper_info = Session::get('question_paper_info');

        //check has selected any subject for question
        if ($question_paper_info == []){ return redirect()->route('practice.select-subject'); }

        //check limit cross
        if ($question_paper_info['question_quantity'] == 0){
            Session::flash('limit_cross', 'Dear '.Auth::user()->name.' '.Auth::user()->last_name.', it\'s time to finished your study.');
            return view('frontend.question.question');
        }
        $subject_id = $question_paper_info['subject_id'];
        $generated_question_ids = $question_paper_info['generated_question_ids'];

        //generate question
        $question = Question::WhereHas('template', function ($query) use ($subject_id) {
            $query->where('subject_id', $subject_id);
        })->whereNotIn('id', $generated_question_ids)->active()->inRandomOrder()->take(1)->first();

        //store question id to prevent generate same question
        array_push($question_paper_info['generated_question_ids'], $question->id);
        $question_paper_info['question_quantity']--;
        Session::put('question_paper_info', $question_paper_info);

        $question_options = $question->options;
        $correct_answers = $student_answer = [];

        return view('frontend.question.question', compact('question', 'question_options', 'correct_answers', 'student_answer'));
    }

    public function submitQuestion(Request $request){

        $request->validate([
            'question_id' => 'required',
            'options' => 'required'
        ]);

        $question_paper_info = Session::get('question_paper_info');
        $examination = Examination::find($question_paper_info['examination_id']);
        $student_answers = array_map('intval', $request->options);

        $answers = [];
        foreach ($student_answers as $student_answer){
            $answers[] = [
                'question_id' => $request->question_id,
                'option_id' => $student_answer,
                'answer' => 1
            ];
        }

        $examination->answers()->createMany($answers);

        return back();
    }

    public function summery()
    {
        $question_paper_info = Session::get('question_paper_info');
        $total_answered_question_ids = $question_paper_info['generated_question_ids'];

        //dd($total_answered_question_ids);

        $right_answer = 0;
        $wrong_answer = 0;

        foreach ($total_answered_question_ids as $answered_question_id){

            //get student answer
            $student_answer = Examination::find($question_paper_info['examination_id'])
                ->answers()->where('question_id', $answered_question_id)
                ->pluck('option_id')->toArray();


            //get question correct answer
            $question_correct_answers = Question::find($answered_question_id)->correctAnswers;

            $correct_answers = [];
            foreach ($question_correct_answers as $answer){
                $correct_answers[] = $answer->id;
            }

            //check two array contain same element or not to know student given answer right or wrong
            sort($student_answer);
            sort($correct_answers);

            $student_answer == $correct_answers ? $right_answer++ : $wrong_answer++;
        }

        return view('frontend.question.summery');

        dd('Total', $total_answered_question_ids, 'Right', $right_answer, 'Wrong', $wrong_answer);
    }

    public function finished(){
        Session::put('question_paper_info', []);
        return redirect()->route('practice.select-subject')->with('success', 'Thank you '.Auth::user()->name.' '.Auth::user()->last_name.', Have a good day.');
    }
}
