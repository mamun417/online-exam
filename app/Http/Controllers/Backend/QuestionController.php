<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Subject;
use App\Model\Question;
use App\Model\Question_type;

class QuestionController extends Controller
{
    
    public function index()
    {

        $questions = Question::with('department', 'subject', 'question_type')->get();

        return view('backend.question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments    = Department::get();
        $subjects       = Subject::get();
        $question_types = Question_type::get();

        return view('backend.question.create', compact('departments', 'subjects', 'question_types'));
    }

 
    public function store(Request $request)
    {
    
         $request->validate([
            'question'      => 'required',
            'department_id' => 'required',
            'subject_id'    => 'required',
            'question_type_id' => 'required'
        ]);



         $request['image'] = 'image';
        
        Question::create($request->all());
        
        return redirect()->route('questions.index')->with('successTMsg','Question save successfully');
    }


    public function edit(Question $question)
    {
        $departments    = Department::get();
        $subjects       = Subject::get();
        $question_types = Question_type::get();

        return view('backend.question.edit', compact('question','departments', 'subjects', 'question_types'));
    }

    
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question'      => 'required',
            'department_id' => 'required',
            'subject_id'    => 'required',
            'question_type_id' => 'required'
        ]);

        $request['image'] = 'image';

        $question->update($request->all());
        return redirect(route('questions.index'))->with('successTMsg', 'Question has been updated successfully'); 
    }

   
    public function destroy(Question $question)
    {
        $question->delete();
        return back()->with('successTMsg', 'Question has been deleted successfully');
    }
}
