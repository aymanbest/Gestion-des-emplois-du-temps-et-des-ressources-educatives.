<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $primaryKey = 'exam_id';

    protected $fillable = [
        "module_id",
        "semester_id",
        "classroom_id",
        "teacher_ids",
        "group_ids",
        "start_time",
        "end_time",
    ];
}
