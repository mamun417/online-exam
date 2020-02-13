<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Question;
use Auth;
use Illuminate\Http\Request;
use Session;

class CommonController extends Controller
{
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
            'generated_question_count' => 200,
        ];

        Session::put('question_paper_info', $question_paper_info);
        return redirect()->route('question');
    }

    public function question()
    {
        $question_paper_info = Session::get('question_paper_info');

        //check has selected any subject for study
        if ($question_paper_info == []){ return redirect()->route('study.select-subject'); }

        //check limit cross
        if ($question_paper_info['generated_question_count'] == 0){
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
        $question_paper_info['generated_question_count']--;
        Session::put('question_paper_info', $question_paper_info);

        $question_options = $question->options;
        $correct_answers = $student_answer = [];

        return view('frontend.question.question', compact('question', 'question_options', 'correct_answers', 'student_answer'));
    }

    public function finished(){
        Session::put('question_paper_info', []);
        return redirect()->route('study.select-subject')->with('success', 'Thank you '.Auth::user()->name.' '.Auth::user()->last_name.', Have a good day.');
    }
}
