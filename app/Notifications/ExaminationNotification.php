<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ExaminationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $notice;
    public $mail_subject;

    public $tries = 3;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notice, $mail_subject)
    {
        $this->notice = $notice;
        $this->mail_subject = $mail_subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(' ')
            ->line(new HtmlString('<b>Hello! </b>'. $notifiable->name .' '. $notifiable->last_name.','))
            ->line(new HtmlString('<span style="float: right">Date: '.date('d-m-Y').'</span><br>'))
            ->subject($this->mail_subject)
            ->line($this->notice);
            //->action('Online Exam', route('examination.prepare'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
