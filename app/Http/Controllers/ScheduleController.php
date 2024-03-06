<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Classes;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Schedule::all();
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
    public function store(StoreScheduleRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        Schedule::create($validatedData);
        return response()->json($validatedData, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $schedules = Classes::find($id)->schedules;
        $class_name = Classes::find($id)->class_name;

        $events = [];

        foreach ($schedules as $schedule) {
            array_push($events, [
                'title' => 'Event ' . $schedule->schedule_id,
                'start' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->start_time,
                'end' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->end_time
            ]);
        }

        return response()->json($events);
    }

    public function showSchedulesByDepartment($department_id)
    {
        $schedules = DB::table('schedules')
            ->join('classes', 'schedules.class_id', '=', 'classes.class_id')
            ->join('departments', 'classes.department_id', '=', 'departments.department_id')
            ->select('schedules.*')
            ->where('departments.department_id', '=', $department_id)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            array_push($events, [
                'title' => 'Event ' . $schedule->schedule_id,
                'start' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->start_time,
                'end' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->end_time
            ]);
        }

        return response()->json($events);
    }

    public function showSchedulesByDepartmentClasses($department_id, $class_id)
    {
        $schedules = DB::table('schedules')
            ->join('classes', 'schedules.class_id', '=', 'classes.class_id')
            ->join('departments', 'classes.department_id', '=', 'departments.department_id')
            ->select('schedules.*')
            ->where('departments.department_id', '=', $department_id)
            ->where('classes.class_id', '=', $class_id)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            array_push($events, [
                'title' => 'Event ' . $schedule->schedule_id,
                'start' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->start_time,
                'end' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->end_time
            ]);
        }

        return response()->json($events);
    }

    public function showSchedulesByYearByDepartmentClasses($department_id, $class_id, $year_id = 1)
    {
        $schedules = DB::table('schedules')
            ->join('classes', 'schedules.class_id', '=', 'classes.class_id')
            ->join('departments', 'classes.department_id', '=', 'departments.department_id')
            ->select('schedules.*')
            ->where('departments.department_id', '=', $department_id)
            ->where('classes.class_id', '=', $class_id)
            ->where('schedules.year_id', '=', $year_id)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            array_push($events, [
                'title' => 'Event ' . $schedule->schedule_id,
                'start' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->start_time,
                'end' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->end_time
            ]);
        }

        return response()->json($events);
    }

    private function getDatesOfWeekdayInCurrentWeek($dayOfWeekString)
    {
        $date = new DateTime(); // create a new DateTime object for the current date
        $weekStart = $date->modify('this week'); // get the date for the start of the week
        $dayOfWeek = strtolower($dayOfWeekString); // convert the day of the week to lowercase

        $dates = array(); // create an empty array to store the dates

        // loop through the days of the week and add each date to the $dates array
        for ($i = 0; $i < 7; $i++) {
            $dateString = $weekStart->format('Y-m-d'); // get the date in the format YYYY-MM-DD

            if (strtolower($weekStart->format('l')) === $dayOfWeek) { // check if the day of the week matches the specified day of the week
                $dates[] = $dateString; // add the date to the $dates array
            }

            $weekStart->modify('+1 day'); // move to the next day
        }

        return $dates; // return the array of dates
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
