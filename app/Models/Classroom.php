<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $primaryKey = 'classroom_id';

    protected $fillable = [
        'name', 'supervisors_capacity', 'cours_seats', 'exam_seats', 'classroom_code'
    ];

    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Schedule::class, 'classroom_id', 'classroom_id');
    }
}
