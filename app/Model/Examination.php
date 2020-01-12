<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = ['user_id', 'is_deleted', 'is_active', 'department_id', 'subject_id', 'total_murks']; 
}
