<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        return response()->json($classrooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($department_id, $class_id)
    {
        $result = DB::table('classrooms as r')
            ->join('schedules as s', 's.classroom_id', '=', 'r.classroom_id')
            ->join('classes as c', 's.class_id', '=', 'c.class_id')
            ->join('departments as d', 'd.department_id', '=', 'c.department_id')
            ->select('r.*')
            ->where('d.department_id', '=', $department_id)
            ->where('c.class_id', '=', $class_id)
            ->get();

        return response()->json($result);
    }

    public function getAvailableClassrooms($dayOfWeek, $startTime, $endTime)
    {
        $classrooms = Classroom::whereNotIn('classroom_id', function ($query) use ($dayOfWeek, $startTime, $endTime) {
            $query->select('classroom_id')
                ->from('schedules')
                ->where('day_of_week', $dayOfWeek)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                        ->orWhereBetween('end_time', [$startTime, $endTime]);
                });
        })->get();

        return response()->json($classrooms);
    }

    public function testing(){
        dd($this->getAvailableClassrooms('Monday', '08:00:00', '10:00:00'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
