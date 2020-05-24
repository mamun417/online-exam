<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Subject;
use Auth;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(){
        $subjects = Department::find(Auth::user()->department_id)->subjects()->withCount('videos')->get();
        return view('frontend.video.subject-list', compact('subjects'));
    }

    public function videos($subject_code){
        $subject = Subject::where('code', $subject_code)->get()->first();
        return view('frontend.video.videos', compact('subject'));
    }
}
