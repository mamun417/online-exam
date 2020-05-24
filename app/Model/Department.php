<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static latest()
 * @method static find($department_id)
 */
class Department extends Model
{
    protected $fillable = ['name', 'is_deleted', 'is_active', 'code'];

    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }
}


