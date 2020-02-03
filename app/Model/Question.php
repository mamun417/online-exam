<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'question_template_id',  'is_active', 'is_deleted', 'description', 'image'];

    /*public function department(){
        return $this->belongsTo(Department::class);
	}

	public function subject(){
        return $this->belongsTo(Subject::class);
	}*/

/*	public function question_type(){
        return $this->belongsTo(QuestionType::class);
	}*/

    public function options(){
        return $this->belongsToMany(Option::class)->withPivot('correct_answer');
    }
}
