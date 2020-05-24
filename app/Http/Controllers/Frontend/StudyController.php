<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Question;
use App\Model\QuestionTemplate;
use App\Model\Subject;
use Auth;
use foo\bar;
use Illuminate\Http\Request;
use Session;

class StudyController extends Controller
{
    public function showSelectSubject()
    {
        // handle warning message
        Session::forget('limit_cross');

        Session::put('question_paper_info', []);

        //check is select any subject for study
        /*$question_paper_info = Session::get('question_paper_info');
        if ($question_paper_info and $question_paper_info['question_paper_type'] == 'study'){
            return redirect()->route('study.question');
        }*/

        $department = Department::find(Auth::user()->department_id);

        $subjects = $department->subjects()->has('questions')->get();

        //$subjects = Subject::has('questions')->get();

        return view('frontend.study.select-subject', compact('subjects'));
    }

    public function selectSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required'
        ]);

        $subject = Subject::withCount('questions')->where('id', $request->subject_id)->first();

        $question_paper_info = [
            'question_paper_type' => 'study',
            'student_id' => Auth::id(),
            'subject_id' => $request->subject_id,
            'generated_question_ids' => [],
            'question_quantity' => $subject->questions_count > 200 ? 200 : $subject->questions_count
        ];

        Session::put('question_paper_info', []);
        Session::put('question_paper_info', $question_paper_info);

        return redirect()->route('study.question');
    }

    public function question()
    {
        $question_paper_info = Session::get('question_paper_info');

        //check has selected any subject for question
        if ($question_paper_info == []){ return redirect()->route('study.select-subject'); }

        //check limit cross
        if ($question_paper_info['question_quantity'] == 0){
            Session::flash('limit_cross', 'Congratulations '.Auth::user()->name.' '.Auth::user()->last_name.', your study is finished. You can restart again.');
            return view('frontend.question.question');
        }

        $subject_id = $question_paper_info['subject_id'];
        $generated_question_ids = $question_paper_info['generated_question_ids'];

        //generate question
        $user = auth()->user();
        if($user->account_type_id==1) {
            $question = Question::where('subject_id', $subject_id)
                ->whereNotIn('id', $generated_question_ids)
                ->active()->inRandomOrder()->take(1)->first();
        }else{
            $question = Question::where('subject_id', $subject_id)
                ->whereNotIn('id', $generated_question_ids)
                ->where('student_type_id', '!=',3)
                ->active()->inRandomOrder()->take(1)->first();
        }

        //store question id to prevent generate same question
        array_push($question_paper_info['generated_question_ids'], $question->id);
        $question_paper_info['question_quantity']--;
        Session::put('question_paper_info', $question_paper_info);

        $question_options = $question->options;
        $student_answer = $true_student_answer = $false_student_answer =  $true_correct_answers = $false_correct_answers = [];

        //dd('ok');

        return view('frontend.question.question', compact('question', 'question_options', 'student_answer', 'true_student_answer', 'false_student_answer', 'true_correct_answers','false_correct_answers'));
    }

    public function submitQuestion(Request $request){

        if(isset($request->options)){
            $request->validate([
                'question_id' => 'required',
                'options' => 'required'
            ]);
        }

        $student_answer = $true_student_answer = $false_student_answer = [];

        if(isset($request->options)) {
            $student_answer = array_map('intval', $request->options);

        }else{
            $true_student_answer = $false_student_answer = [];

            if(isset($request->options_true)) {
                $true_student_answer = array_map('intval', $request->options_true);
            }

            if(isset($request->options_false)) {
                $false_student_answer = array_map('intval', $request->options_false);
            }
        }

        //get question correct answer
        $question = Question::find($request->question_id);


        $question_true_correct_answers = $question->trueCorrectAnswers;
        $true_correct_answers = [];
        foreach ($question_true_correct_answers as $answer){
            $true_correct_answers[] = $answer->id;
        }

        $question_false_correct_answers = $question->falseCorrectAnswers;
        $false_correct_answers = [];
        foreach ($question_false_correct_answers as $answer){
            $false_correct_answers[] = $answer->id;
        }

        //check two array contain same element or not to know student given answer right or wrong
        sort($student_answer);

        sort($true_correct_answers);
        sort($false_correct_answers);

        $answer = false;
        if(isset($request->options)) {
            $answer = $student_answer == $true_correct_answers ? true : false;
        }else{
            sort($true_student_answer);
            sort($false_student_answer);

            $true_answer = $true_student_answer == $true_correct_answers ? true : false;
            $false_answer = $false_student_answer == $false_correct_answers ? true : false;

            if ($true_answer && $false_answer) {
                $answer = true;
            }
        }

        if ($answer) {
            Session::flash('success', 'Your given answer is correct.');
            return back();
        }

        //if question answer not correct
        $question_options = $question->options;

        Session::flash('error', 'Incorrect answer.');
        return view('frontend.question.question',
            compact('question','question_options', 'student_answer', 'true_student_answer', 'false_student_answer', 'true_correct_answers','false_correct_answers')
        );
    }

    public function finished(){
        Session::put('question_paper_info', []);
        return redirect()->route('study.select-subject')->with('success', 'Thank you '.Auth::user()->name.' '.Auth::user()->last_name.', Have a good day.');
    }
}
