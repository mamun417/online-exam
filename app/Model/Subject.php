<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $all)
 * @method static doesntHave(string $string)
 * @method static whereDoesntHave(string $string, \Closure $param)
 * @method static find($subject_id)
 * @method static has(string $string)
 * @method static withCount(string $string)
 */
class Subject extends Model
{
    protected $fillable = ['name', 'subject_code', 'code', 'is_active', 'is_deleted'];

    public function questionTemplates(){
        return $this->hasMany(QuestionTemplate::class);
    }

    public function questions(){
        $user = auth()->user();
        $questions = $this->hasMany(Question::class);
        if($user->account_type_id !=1) {
            $questions->where('student_type_id','!=',3);
        }
        return $questions;
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }
}

