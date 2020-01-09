<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subject $Subject)
    {
        $subjects = Subject::get();
        return view('backend.subject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|unique:Subjects',
            'subject_code' => 'required|unique:Subjects',
        ]);

        $request['code'] = strtolower(str_replace(' ', '-', $request->name));
        $subject = new Subject($request->all());
        if($subject->save()){
            return back()->with('success','Subject Save Success');
        }else{
            return back()->with('error','Subject Could not be Save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('backend.subject.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'subject_code' => 'required',
        ]);

        $request['code'] = strtolower(str_replace(' ', '-', $request->name));
        $update = $subject->update($request->all());
        if($update){
            return redirect(route('subject.index'))->with('success','Subject Updated Success');
        }else{
            return redirect(route('subject.index'))->with('error','Subject Could not be Updated');
        }

    }



    public function destroy(Subject $subject)
    {
        if($subject->delete()){
            return redirect(route('subject.index'))->with('success','Subject Delete Successfully');
        }else{
            return redirect(route('subject.index'))->with('error','Subject Could not be Deleted');
        }
    }
}
