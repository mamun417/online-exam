<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static WhereHas(string $string, \Closure $param)
 * @method static find($question_id)
 */
class Question extends Model
{
    protected $fillable = ['question', 'slug', 'question_template_id', 'student_type_id', 'question_type_id', 'subject_id', 'is_active', 'is_deleted', 'description', 'image'];

    public function template(){
        return $this->belongsTo(QuestionTemplate::class, 'question_template_id');
	}

    public function questionType(){
        return $this->belongsTo(QuestionType::class);
    }

	public function subject(){
        return $this->belongsTo(Subject::class);
	}

    public function studentType(){
        return $this->belongsTo(StudentType::class);
    }
/*
	public function department(){
        return $this->belongsTo(Department::class);
	}
*/
    public function options(){
        return $this->belongsToMany(Option::class)->withPivot('correct_answer');
    }

    public function scopeActive($query){
        return $query->where('is_active', true);
    }

    public function trueCorrectAnswers(){
        return $this->belongsToMany(Option::class)->wherePivot('correct_answer',1);
    }

    public function falseCorrectAnswers(){
        return $this->belongsToMany(Option::class)->wherePivot('correct_answer','0');
    }

}
