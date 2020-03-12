<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\StudentType;
use App\Model\Subject;
use App\Model\Department;
use App\Model\QuestionType;
use App\Model\Question;
use App\Model\QuestionTemplate;
use Illuminate\Http\Request;

class QuestionTemplateController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $questionTemplates =  QuestionTemplate::with('department', 'subject', 'studentType');

        if($keyword){

            $keyword = '%'.$keyword.'%';

            $questionTemplates = $questionTemplates->where('name', 'like', $keyword)
                ->WhereHas('department', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                })
                ->orWhereHas('subject', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                })
                ->orWhereHas('studentType', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                });
        }

        $questionTemplates = $questionTemplates->withCount('questions')->latest()->paginate($perPage);

        return view('admin.question-template.index', compact('questionTemplates'));
    }

    public function create()
    {
        $departments = Department::latest()->get();
        $subjects  = Subject::doesntHave('questionTemplates')->latest()->get();
        $studentTypes = StudentType::latest()->get();

        return view('admin.question-template.create', compact('departments', 'subjects', 'studentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required',
            //'department_id'    => 'required',
            'subject_id'       => 'required|unique:question_templates',
            'student_type_id'  => 'required',
            'total_questions'  => 'required',
            'total_marks'      => 'required'
        ],[
            'subject_id.unique' => 'This subject already has template.'
        ]);

        QuestionTemplate::create($request->all());

        return redirect()->route('admin.question-templates.index')->with('successTMsg','Question Template save successfully');
    }

    public function edit(QuestionTemplate $questionTemplate)
    {
        $template_subject_id = $questionTemplate->subject->id;
        $departments = Department::latest()->get();
        $studentTypes = StudentType::latest()->get();

        $subjects = Subject::whereDoesntHave('questionTemplates', function ($q) use ($template_subject_id){
            $q->where('subject_id', '!=', $template_subject_id);
        })->latest()->get();

        return view('admin.question-template.edit', compact('questionTemplate', 'departments', 'subjects', 'studentTypes'));
    }

    public function update(Request $request, QuestionTemplate $questionTemplate)
    {
         $request->validate([
            'name'             => 'required',
            //'department_id'    => 'required',
            'subject_id'       => 'required|unique:question_templates,subject_id,'.$questionTemplate->id,
            'student_type_id'  => 'required',
            'total_questions'  => 'required',
            'total_marks'      => 'required'
        ]);

        $questionTemplate->update($request->all());
        return redirect(route('admin.question-templates.index'))->with('successTMsg', 'Question Template has been updated successfully');
    }

    public function destroy(QuestionTemplate $questionTemplate)
    {
        $questionTemplate->delete();
        return back()->with('successTMsg', 'Question template has been deleted successfully');
    }
}
