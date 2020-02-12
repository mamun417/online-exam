<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $all)
 * @method static has(string $string, string $string1, int $int)
 * @method static whereHas(string $string, \Closure $param, string $string1, int $int)
 */
class Subject extends Model
{
    protected $fillable = ['name', 'subject_code', 'code', 'is_active', 'is_deleted'];

    public function questionTemplates(){
        return $this->hasMany(QuestionTemplate::class);
    }
}

