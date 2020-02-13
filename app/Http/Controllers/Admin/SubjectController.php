<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Subject;
use Illuminate\Http\Request;
use Str;

class SubjectController extends Controller
{
    public function index()
    {
        $perPage = request()->perPage ?: 10;
        $keyword = request()->keyword;

        $subjects = new Subject();

        if ($keyword){
            $subjects = $subjects->where('name', 'like', '%'.request()->keyword.'%')
                        ->orWhere('subject_code', 'like', '%'.request()->keyword.'%');
        }

        $subjects = $subjects->latest()->paginate($perPage);

        return view('admin.subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:subjects',
            'subject_code' => 'required|max:255|unique:subjects'
        ]);

        $request['code'] = Str::slug($request->name);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')->with('successTMsg', 'Subject save successfully');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'         => 'required|max:255|unique:subjects,name,'.$subject->id,
            'subject_code' => 'required|max:255|unique:subjects,subject_code,'.$subject->id
        ]);

        $request['code'] = Str::slug($request->name);

        $subject->update($request->all());

        return redirect(route('admin.subjects.index'))->with('successTMsg', 'Subject has been updated successfully');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back()->with('successTMsg', 'Subject has been deleted successfully');
    }
}
