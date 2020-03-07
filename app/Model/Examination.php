<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static find($get)
 */
class Examination extends Model
{
    protected $fillable = ['user_id', 'department_id', 'subject_id', 'exam_notification_id'];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
