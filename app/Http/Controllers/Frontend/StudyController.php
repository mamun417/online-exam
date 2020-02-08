<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Subject;
use Auth;
use Illuminate\Http\Request;
use Session;

class StudyController extends Controller
{
    public function showSelectSubject()
    {
        $subjects = Subject::all();
        return view('frontend.study.select-subject', compact('subjects'));
    }

    public function selectSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required'
        ]);

        $study = [
            'student_id' => Auth::id(),
            'subject_id' => $request->subject_id
        ];

        return redirect()->route('study.question');

        //Session::put('study', $study);
    }

    public function question()
    {
        return view('frontend.study.question');
    }
}
