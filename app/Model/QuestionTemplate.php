<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuestionTemplate extends Model
{
    protected $fillable = ['name', 'department_id', 'subject_id', 'question_type_id', 'is_active', 'is_deleted', 'total_questions', 'total_marks', 'negative_marks'];

     public function department(){
			return $this->hasOne(Department::class,'id', 'department_id');
	}

	public function subject(){
			return $this->hasOne(Subject::class,'id', 'subject_id');
	}

	public function questionType(){
			return $this->hasOne(QuestionType::class,'id', 'question_type_id');
	}
}
