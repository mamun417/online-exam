<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Examination;
use App\Model\ExamNotification;
use Illuminate\Http\Request;

class TopScorerController extends Controller
{
    public function index(){

        $exam_notification = ExamNotification::latest()->first();
        $subject_id = $exam_notification->template->subject_id;

        $results = Examination::with('user')->where('subject_id', $subject_id)
            ->where('is_exam', true)
            ->orderBy('result', 'DESC')->paginate(15);

        return view('frontend.result.index', compact('results'));
    }
}
