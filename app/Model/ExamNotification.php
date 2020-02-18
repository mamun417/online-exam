<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $all)
 */
class ExamNotification extends Model
{
    protected $dates = ['start_date', 'end_date'];

    protected $fillable = ['subject_id', 'mail_subject', 'notice', 'duration', 'start_date', 'end_date'];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
