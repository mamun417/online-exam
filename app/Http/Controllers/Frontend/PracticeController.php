<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Examination;
use App\Model\Question;
use App\Model\QuestionTemplate;
use App\Model\Subject;
use Auth;
use Illuminate\Http\Request;
use Session;

class PracticeController extends Controller
{
    public function showSelectSubject()
    {
        Session::forget('limit_cross');

        Session::put('question_paper_info', []);

        /*$question_paper_info = Session::get('question_paper_info');
        if ($question_paper_info and $question_paper_info['question_paper_type'] == 'practice'){
            return redirect()->route('practice.question');
        }*/

        $subjects = Subject::has('questions')->get();
        return view('frontend.practice.select-subject', compact('subjects'));
    }

    public function selectSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'question_quantity' => 'required'
        ]);

        $subject = Subject::withCount('questions')->where('id', $request->subject_id)->first();

        $examination = Examination::create([
            'user_id' => Auth::id(),
            'subject_id' => $request->subject_id,
        ]);

        $request_quantity = $request->question_quantity;

        $question_paper_info = [
            'question_paper_type' => 'practice',
            'examination_id' => $examination->id,
            'student_id' => Auth::id(),
            'subject_id' => $request->subject_id,
            'generated_question_ids' => [],
            'question_quantity' => $subject->questions_count > $request_quantity ? $request_quantity : $subject->questions_count
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
            return redirect()->route('practice.summery');
        }

        $subject_id = $question_paper_info['subject_id'];
        $generated_question_ids = $question_paper_info['generated_question_ids'];

        //generate question
        $question = Question::where('subject_id', $subject_id)
            ->whereNotIn('id', $generated_question_ids)->active()->inRandomOrder()->take(1)->first();

        //store question id to prevent generate same question
        array_push($question_paper_info['generated_question_ids'], $question->id);
        $question_paper_info['question_quantity']--;
        Session::put('question_paper_info', $question_paper_info);

        $question_options = $question->options;
        $correct_answers = $student_answer = [];

        return view('frontend.question.question', compact('question', 'question_options', 'correct_answers', 'student_answer'));
    }

    public function submitQuestion(Request $request)
    {
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

        if (!isset($question_paper_info['examination_id']) || ($question_paper_info['question_quantity'] > 0)){
           Session::flash('limit_cross', 'You have no summery yet.');
           return view('frontend.question.summery');
        }

        $subject = Subject::find($question_paper_info['subject_id']);
        $total_answered_question_ids = $question_paper_info['generated_question_ids'];

        $right_answer = 0;
        $wrong_answer = 0;

        $ids_ordered = implode(',', $total_answered_question_ids);

        $total_questions = Question::with('options')->whereIn('id', $total_answered_question_ids)
            ->orderByRaw("FIELD(id, $ids_ordered)")->get();

        foreach ($total_questions as $question){

            //get student answer
            $student_answer = Examination::find($question_paper_info['examination_id'])
                ->answers()->where('question_id', $question->id)
                ->pluck('option_id')->toArray();


            $question['student_answer'] = $student_answer;

            //get question correct answer
            $correct_answers = [];
            foreach ($question->correctAnswers as $answer){
                $correct_answers[] = $answer->id;
            }

            $question['original_answer'] = $correct_answers;

            //check two array contain same element or not to know student given answer right or wrong
            sort($student_answer);
            sort($correct_answers);

            $student_answer == $correct_answers ? $right_answer++ : $wrong_answer++;
            $question['is_correct_answer'] = $student_answer == $correct_answers;
        }

        $question_template = QuestionTemplate::where('subject_id', $question_paper_info['subject_id'])->get()->first();
        $per_question_mark = $question_template->total_marks/$question_template->total_questions;

        //examination table update with result
        if ($question_paper_info['question_paper_type'] == 'examination'){
            //dd($per_question_mark*$right_answer);
            Examination::where('id', $question_paper_info['examination_id'])->update([
                'result' => ($per_question_mark*$right_answer)-($wrong_answer*$subject->questionTemplates->first()->negative_marks),
                'is_exam' => true
            ]);
        }

        return view('frontend.question.summery', compact('subject','total_questions', 'right_answer', 'wrong_answer', 'per_question_mark'));
    }

    public function finished()
    {
        $question_paper_info = Session::get('question_paper_info');
        $question_paper_info['question_quantity'] = 0;
        Session::put('question_paper_info', $question_paper_info);

        $question_paper_type = $question_paper_info['question_paper_type'];
        if ($question_paper_type == 'practice'){
            return redirect()->route('practice.select-subject');
        }elseif ($question_paper_type = 'examination'){
            return redirect()->route('examination.prepare');
        }
        //return redirect()->route($question_paper_type.'.summery');
    }

    public function restart()
    {
        Session::put('question_paper_info', []);
        return redirect()->route('practice.select-subject')->with('success', 'Thank you '.Auth::user()->name.' '.Auth::user()->last_name.', Have a good day.');
    }
}
