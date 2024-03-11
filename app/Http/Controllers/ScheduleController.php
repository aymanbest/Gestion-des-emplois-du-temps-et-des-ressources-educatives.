<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Classes;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Year;
use App\Models\Module;
use App\Models\Classroom;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Schedule::with('year', 'semester', 'group', 'classes', 'module', 'teacher', 'classeroom')->get();
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
        //notify()->success('Insert was successful!');
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

    public function showSchedulesByYearByDepartmentClasses($department_id, $class_id, $year_id)
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

    public function showSchedulesByYearByDepartmentClassesGroup($department_id, $class_id, $year_id, $group_id)
    {
        $schedules = DB::table('schedules')
            ->join('classes', 'schedules.class_id', '=', 'classes.class_id')
            ->join('departments', 'classes.department_id', '=', 'departments.department_id')
            ->join('modules', 'schedules.module_id', '=', 'modules.module_id')
            ->join('classrooms', 'schedules.classroom_id', '=', 'classrooms.classroom_id')
            ->join('teachers', 'schedules.teacher_id', '=', 'teachers.teacher_id')
            ->join('teacher_types', 'teachers.teacher_type_id', '=', 'teacher_types.teacher_type_id') // Join the teacher_types table
            ->join('semesters', 'schedules.semester_id', '=', 'semesters.semester_id') // Join the semesters table
            ->select('schedules.*', 'modules.name as module_name', 'classrooms.classroom_code', 'teachers.fullname', 'teacher_types.teacher_type_id') // Select the required fields including teacher_types_id
            ->where('departments.department_id', '=', $department_id)
            ->where('classes.class_id', '=', $class_id)
            ->where('schedules.year_id', '=', $year_id)
            ->where('schedules.group_id', '=', $group_id)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            array_push($events, [
                'title' => $schedule->module_name . ' ' . $schedule->classroom_code,
                'start' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->start_time,
                'end' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->end_time,
                'schedule_id' => $schedule->schedule_id,
                'class_id' => $schedule->class_id,
                'module_id' => $schedule->module_id,
                'classroom_id' => $schedule->classroom_id,
                'teacher_id' => $schedule->teacher_id,
                'teacher_type_id' => $schedule->teacher_type_id,
                'semester_id' => $schedule->semester_id,
                'day_of_week' => $schedule->day_of_week,
                'start_time' => $schedule->start_time,
                'end_time' => $schedule->end_time,
                'year_id' => $schedule->year_id,
                'group_id' => $schedule->group_id,
                'module_name' => $schedule->module_name,
                'classroom_code' => $schedule->classroom_code,
                'teacher_fullname' => $schedule->fullname,
                'department_id' => $department_id
            ]);
        }

        if (empty($events)) {
            // notify()->error('No events found On this Weak');
            return response()->json(['status' => 'empty']);
        }

        return response()->json($events);
    }


    public function getTeacherReport($teacher_id)
    {
        $report = DB::table('schedules')
            ->join('teachers', 'schedules.teacher_id', '=', 'teachers.teacher_id')
            ->join('groups', 'schedules.group_id', '=', 'groups.group_id')
            ->join('classes', 'schedules.class_id', '=', 'classes.class_id')
            ->join('departments', 'classes.department_id', '=', 'departments.department_id')
            ->select(
                'teachers.fullname as teacher_name',
                'groups.group_id',
                'classes.name as class_name',
                'departments.name as department_name',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, schedules.start_time, schedules.end_time)) as total_duration')
            )
            ->where('teachers.teacher_id', '=', $teacher_id)
            ->groupBy('classes.name', 'departments.name', 'teachers.fullname', 'groups.group_id')
            ->groupBy('departments.name', 'classes.name') // Add grouping by department and class
            ->get();

            if ($report->isEmpty()) {
               
                return response()->json(['status' => 'empty']);
            }
    

        return response()->json($report);
    }


    // public function showSchedulesByYearByDepartmentClassesGroup($department_id, $class_id, $year_id = 1, $group_id)
    // {
    // $schedules = DB::table('schedules')
    //     ->join('classes', 'schedules.class_id', '=', 'classes.class_id')
    //     ->join('departments', 'classes.department_id', '=', 'departments.department_id')
    //     ->join('modules', 'schedules.module_id', '=', 'modules.module_id') // Join the modules table
    //     ->join('classrooms', 'schedules.classroom_id', '=', 'classrooms.classroom_id') // Join the classroom table
    //     ->join('teachers', 'schedules.teacher_id', '=', 'teachers.teacher_id') // Join the teachers table
    //     ->select('schedules.*', 'modules.name as module_name', 'classrooms.classroom_code', 'teachers.fullname') // Select the required fields
    //     ->where('departments.department_id', '=', $department_id)
    //     ->where('classes.class_id', '=', $class_id)
    //     ->where('schedules.year_id', '=', $year_id)
    //     ->where('schedules.group_id', '=', $group_id)
    //     ->get();

    //     $events = [];

    // foreach ($schedules as $schedule) {
    //     array_push($events, [
    //         'title' => 'Event ' . $schedule->schedule_id,
    //         'start' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->start_time,
    //         'end' => $this->getDatesOfWeekdayInCurrentWeek($schedule->day_of_week)[0] . 'T' . $schedule->end_time,
    //         'module_name' => $schedule->module_name, // Add the module name to the event
    //         'classroom_code' => $schedule->classroom_code, // Add the classroom code to the event
    //         'teacher_fullname' => $schedule->fullname // Add the teacher's fullname to the event
    //     ]);
    // }

    //     if (empty($events)) {
    //         return response()->json(['status' => 'empty']);
    //     }

    //     return response()->json($events);
    // }

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

    // function getDatesOfWeekdayInCurrentWeek($dayOfWeekString, $givenDate)
    // {
    //     $date = new DateTime($givenDate); // create a new DateTime object for the given date
    //     $weekStart = $date->modify('this week'); // get the date for the start of the week
    //     $dayOfWeek = strtolower($dayOfWeekString); // convert the day of the week to lowercase

    //     $dates = array(); // create an empty array to store the dates

    //     // loop through the days of the week and add each date to the $dates array
    //     for ($i = 0; $i < 7; $i++) {
    //         $dateString = $weekStart->format('Y-m-d'); // get the date in the format YYYY-MM-DD

    //         if (strtolower($weekStart->format('l')) === $dayOfWeek) { // check if the day of the week matches the specified day of the week
    //             $dates[] = $dateString; // add the date to the $dates array
    //         }

    //         $weekStart->modify('+1 day'); // move to the next day
    //     }

    //     return $dates; // return the array of dates
    // }
    public function changeDayOfWeek(Request $request)
    {
        // Validate the request data
        $request->validate([
            'schedule_id' => 'required|exists:schedules,schedule_id',
            'day_of_week' => 'required|string|max:10',
        ]);

        // Find the schedule and update the day_of_week
        $schedule = Schedule::find($request->schedule_id);
        $schedule->day_of_week = $request->day_of_week;
        $schedule->save();

        return response()->json(['message' => 'Schedule updated successfully']);
    }



    public function getSchedulesForWeek(Request $request)
    {
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');

        $date = new \DateTime($year . '-' . $month . '-' . $day);
        $weekStart = clone $date;
        $weekStart->modify('Monday this week');
        $weekEnd = clone $date;
        //dd($weekStart);
        $weekEnd = $date->modify('Sunday this week');

        $dayOfWeek = strtolower($weekStart->format('l'));
        $dayendofWeek = strtolower($weekEnd->format('l'));
        //dd($dayOfWeek);


        $yearModel = Year::where('year', $year)->first();
        $yearId = $yearModel ? $yearModel->year_id : null;
        // dd($yearId);


        $schedules = Schedule::where('year_id', $yearId)
            ->where('day_of_week', [$dayOfWeek, $dayendofWeek])
            ->get();

        dd($schedules);


        $events = [];

        foreach ($schedules as $schedule) {
            array_push($events, [
                'title' => 'Schedule ' . $schedule->schedule_id,
                'start' => $weekStart->format('Y-m-d') . 'T' . $schedule->start_time,
                'end' => $weekStart->format('Y-m-d') . 'T' . $schedule->end_time
            ]);
        }

        return response()->json($events);
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
    public function update(Request $request, Schedule $schedule)
    {
        //dd($request->all());
        $request->validate([
            'class_id' => 'required',
            'module_id' => 'required',
            'classroom_id' => 'required',
            'teacher_id' => 'required',
            'semester_id' => 'required',
            'day_of_week' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'year_id' => 'required',
            'group_id' => 'required',
        ]);

        // Find the schedule
        $schedule->update($request->all());

        // Return a response
        return response()->json(['message' => 'Schedule updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully']);
    }
}
