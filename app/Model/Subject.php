<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $all)
 * @method static doesntHave(string $string)
 * @method static whereDoesntHave(string $string, \Closure $param)
 */
class Subject extends Model
{
    protected $fillable = ['name', 'subject_code', 'code', 'is_active', 'is_deleted'];

    public function questionTemplates(){
        return $this->hasMany(QuestionTemplate::class);
    }
}

