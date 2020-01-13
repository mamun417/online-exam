<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Examination;
use App\Model\Department;
use App\Model\Subject;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
   
    public function index()
    {
        $examinations = Examination::with('department', 'subject')->get();
        return view('backend.examination.index',compact('examinations'));
    }


    public function create()
    {
        $departments = Department::get();
        $subjects    = Subject::get();

        return view('backend.examination.create', compact('departments', 'subjects'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'subject_id'    => 'required',
            'total_marks'   => 'required'
        ]);

        $request['user_id'] = 1;

        Examination::create($request->all());
        return redirect()->route('examinations.index')->with('successTMsg','Examination save successfully');
    }

 

    public function show($id)
    {
        //
    }

 

    public function edit(Examination $examination)
    {
        $departments  = Department::get();
        $subjects     = Subject::get();

        return view('backend.examination.edit', compact('examination','departments', 'subjects'));
    }



    public function update(Request $request, Examination $examination)
    {
        $request->validate([
            'department_id' => 'required',
            'subject_id'    => 'required',
            'total_marks'   => 'required'
        ]);

        $request['user_id'] = 1;

        $examination->update($request->all());
        return redirect(route('examinations.index'))->with('successTMsg', 'Examination has been updated successfully');  
    }

  

    public function destroy(Examination $examination)
    {
        $examination->delete();
        return back()->with('successTMsg', 'Examination has been deleted successfully');
        
    }
}
