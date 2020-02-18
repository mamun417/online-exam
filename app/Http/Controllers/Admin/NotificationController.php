<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ExamNotification;
use App\Model\Subject;
use App\Notifications\ExaminationNotification;
use App\User;
use Illuminate\Http\Request;
use Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = ExamNotification::with('subject')->latest()->paginate(25);
        return view('admin.notification.index', compact('notifications'));
    }

    public function create()
    {
        $subjects = Subject::has('questionTemplates')->latest()->get();
        return view('admin.notification.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'mail_subject' => 'required',
            'start_date' => 'required',
            'notice' => 'required'
        ]);

        $start_date = $request->start_date;
        $subject = Subject::find($request->subject_id);
        $notice = str_replace(['[[SUBJECT]]', '[[DATE-TIME]]'], [strtolower($subject->name), $start_date], $request->notice);

        $request['start_date'] = date('Y-m-d H:i:s', strtotime($request->start_date));
        $request['end_date'] = date('Y-m-d H:i:s',strtotime($request->start_date)+$request->duration*60*60);
        $request['notice'] = $notice;
        ExamNotification::create($request->all());

        //send notification to paid users
        $paid_users = User::paid()->get();
        Notification::send($paid_users, new ExaminationNotification($notice, $request->mail_subject));

        return redirect()->route('admin.notifications.index')->with('successTMsg', 'Notification save successfully');
    }

    public function destroy(ExamNotification $notification)
    {
        $notification->delete();
        return back()->with('successTMsg', 'Notification has been deleted successfully');
    }
}
