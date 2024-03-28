<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class TeacherAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['classroom_id', 'teacher_id', 'start_time', 'end_time', 'date'];

    public function teacher()
{
    return $this->belongsTo(Teacher::class, 'teacher_id');
}
}
