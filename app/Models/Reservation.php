<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id', 'teacher_id', 'schedule_id'];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id', 'teacher_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id', 'classroom_id');
    }
}
