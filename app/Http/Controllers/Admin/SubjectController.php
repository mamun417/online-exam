<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Subject;
use Illuminate\Http\Request;
use Str;

class SubjectController extends Controller
{
    public function index()
    {
        $perPage = request()->perPage ?: 10;
        $keyword = request()->keyword;

        $subjects = Subject::with('departments');

        if ($keyword){
            $subjects = $subjects->where('name', 'like', '%'.request()->keyword.'%')
                        ->orWhere('subject_code', 'like', '%'.request()->keyword.'%');
        }

        $subjects = $subjects->latest()->paginate($perPage);

        return view('admin.subject.index', compact('subjects'));
    }

    public function create()
    {
        $departments = [];
        return view('admin.subject.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:subjects',
            'subject_code' => 'required|max:255|unique:subjects',
            'department_id' => 'required'
        ],[
            'department_id.required' => 'The faculty field is required.'
        ]);

        $request['code'] = Str::slug($request->name);

        $subject = Subject::create($request->all());

        $subject->departments()->attach($request->department_id);

        return redirect()->route('admin.subjects.index')->with('successTMsg', 'Subject save successfully');
    }

    public function edit(Subject $subject)
    {
        $departments = $subject->departments;

        $subject_departments = array_map(function ($department) {
            return $department['id'];
        }, $subject->departments->toArray());

        return view('admin.subject.edit', compact('subject', 'departments', 'subject_departments'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'         => 'required|max:255|unique:subjects,name,'.$subject->id,
            'subject_code' => 'required|max:255|unique:subjects,subject_code,'.$subject->id,
            'department_id' => 'required'
        ],[
            'department_id.required' => 'The faculty field is required.'
        ]);

        $request['code'] = Str::slug($request->name);

        $subject->update($request->all());

        $subject->departments()->sync($request->department_id);

        return redirect(route('admin.subjects.index'))->with('successTMsg', 'Subject has been updated successfully');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        $subject->departments()->detach();
        return back()->with('successTMsg', 'Subject has been deleted successfully');
    }
}
