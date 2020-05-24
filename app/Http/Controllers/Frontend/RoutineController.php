<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\ExamNotification;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function index(){

        $notifications = ExamNotification::latest()->get()->toArray();

        $notifications = array_map(function ($notification){

            $formatted_data = [
                'title' => $notification['mail_subject'],
                'start' => date('Y-m-d', strtotime($notification['start_date'])),
                'description' => $notification['notice']
            ];

            return $formatted_data;

        }, $notifications);

        $events = json_encode($notifications);

        return view('frontend.event.index', compact('events'));
    }
}

