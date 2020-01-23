<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereIn(string $string, $options)
 * @method static create(array $array)
 */
class Option extends Model
{
    protected $fillable = ['option', 'correct_answer'];
}
