<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Subject;
use App\Model\Question;
use App\Model\Question_type;
use App\Http\Controllers\Components\fileHandlerComponent;

class QuestionController extends Controller
{
    //create file handler component class object
    function __construct()
    {
        $this->fileHandler = new fileHandlerComponent();
    }
    
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $questions = new Question();
        if($keyword){
           $questions =  $questions->where('question', 'like', '%'.$keyword.'%');
        }

        $questions = Question::with('department', 'subject', 'question_type')->latest()->paginate($perPage);

        return view('backend.question.index',compact('questions'));
    }

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

        if($request->img){
            $image = $this->fileHandler->imageUpload($request->file('img'), 'img');
            $request['image'] = $image;
        }
         
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

        if($request->img){

            $image = $this->fileHandler->imageUpload($request->file('img'), 'img');
            $request['image'] = $image;

            if($request->oldImage){

                $this->fileHandler->imageDelete($request->oldImage);
            }
        }

        $question->update($request->all());
        return redirect(route('questions.index'))->with('successTMsg', 'Question has been updated successfully'); 
    }

    public function destroy(Question $question)
    {

        if ($question->delete()) {
            if ($question->image) {
                $this->fileHandler->imageDelete($question->image);
            }
            return back()->with('successTMsg', 'Question has been deleted successfully');
        }else{
            return back()->with('errorTMsg', 'Question has been deleted successfully');
        }

    }
}
