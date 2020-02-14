<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['examination_id', 'question_id', 'option_id', 'answer'];
}
