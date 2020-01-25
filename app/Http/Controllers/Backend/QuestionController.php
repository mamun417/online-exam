<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Option;
use App\Model\QuestionType;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Subject;
use App\Model\Question;
use App\Http\Controllers\Components\fileHandlerComponent;

class QuestionController extends Controller
{
    public $fileHandler;

    //create file handler component class object
    function __construct()
    {
        $this->fileHandler = new fileHandlerComponent();
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $questions =  Question::with('department', 'subject', 'question_type');

        if($keyword){

            $keyword = '%'.$keyword.'%';

            $questions = $questions->where('question', 'like', $keyword)
                ->orWhere('description', 'like', $keyword)
                ->orWhereHas('department', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                })
                ->orWhereHas('subject', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                })
                ->orWhereHas('question_type', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                });
        }

        $questions = $questions->latest()->paginate($perPage);

        $departments = Department::all();
        $subjects = Subject::all();
        $question_types = QuestionType::all();

        return view('backend.question.index', compact('questions', 'departments', 'subjects', 'question_types'));
    }

    public function create()
    {
        $departments    = Department::all();
        $subjects       = Subject::all();
        $question_types = QuestionType::all();
        $options        = Option::all();

        return view('backend.question.create', compact('departments', 'subjects', 'question_types', 'options'));
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

        //store options
        $option_ids = $this->storeOptions($request->options);

        $question = Question::create($request->all());

        $question->options()->attach($option_ids);

        return redirect()->route('questions.index')->with('successTMsg', 'Question save successfully');
    }

    public function edit(Question $question)
    {
        $departments    = Department::all();
        $subjects       = Subject::all();
        $question_types = QuestionType::all();
        $options        = $question->options;

        return view('backend.question.edit', compact('question','departments', 'subjects', 'question_types', 'options'));
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

        //store options
        $option_ids = $this->storeOptions($request->options);

        $question->update($request->all());

        $question->options()->sync($option_ids);

        return redirect(route('questions.index'))->with('successTMsg', 'Question has been updated successfully');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        if ($question->image) {
            $this->fileHandler->imageDelete($question->image);
        }

        return back()->with('successTMsg', 'Question has been deleted successfully');
    }

    public function storeOptions($request_options = []){

        $exist_ids = Option::whereIn('id', $request_options)->pluck('id')->toArray();

        $store_able_options = array_merge(array_diff($request_options, $exist_ids), array_diff($exist_ids, $request_options));

        $created_ids = [];

        foreach ($store_able_options as $option){
            $create_option = Option::create(['option' => $option]);
            $created_ids[] = $create_option->id;
        }

        return array_merge($exist_ids, $created_ids);
    }
}
