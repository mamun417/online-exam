<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'department_id', 'subject_id', 'question_type_id', 'is_active', 'is_deleted', 'description', 'image'];

     public function department(){
			return $this->hasOne(Department::class,'id', 'department_id');
	}

	public function subject(){
			return $this->hasOne(Subject::class,'id', 'subject_id');
	}

	public function question_type(){
			return $this->hasOne(Question_type::class,'id', 'question_type_id');
	}
}
