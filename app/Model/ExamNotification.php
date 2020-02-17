<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $all)
 */
class ExamNotification extends Model
{
    protected $fillable = ['subject_id', 'mail_subject', 'start_date', 'notice'];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
