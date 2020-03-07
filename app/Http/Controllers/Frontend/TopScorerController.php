<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Examination;
use App\Model\ExamNotification;
use App\Model\QuestionTemplate;
use Illuminate\Http\Request;

class TopScorerController extends Controller
{
    public function index(){

        $keyword = request()->keyword;
        $results = Examination::with('user');

        if($keyword){

            $keyword = '%'.$keyword.'%';

            $results = $results->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', $keyword)
                    ->orWhere('last_name', 'like', $keyword);
            });
        }

        $results = $results->where('is_exam', true)
            ->orderBy('result', 'DESC')->paginate(15);

        return view('frontend.result.index', compact('results'));
    }
}
