<?php

namespace App\Http\Controllers;
use App\Models\TeacherAttendance;

use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function store(Request $request)
    {
        $attendance = new TeacherAttendance;
        $attendance->classroom_id = $request->classroom_id;
        $attendance->teacher_id = $request->teacher_id;
        $attendance->start_time = $request->start_time;
        $attendance->end_time = $request->end_time;

        $attendance->date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');

        $attendance->save();

        return response()->json(['status' => 'success', 'attendance' => $attendance]);
    }

    public function show(Request $request)
    {
        $date = $request->query('date');
        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');

        $attendance = TeacherAttendance::with('teacher')->where('date', $date)->get();

        return response()->json(['status' => 'success', 'attendance' => $attendance]);
    }
}
