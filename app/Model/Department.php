<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name','is_deleted','is_active','code'];
}
