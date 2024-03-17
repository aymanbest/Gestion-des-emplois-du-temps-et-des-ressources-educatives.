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
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Reservation;
use Illuminate\Support\Carbon;


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

        return response()->json(['status' => 'success', 'events' => $events]);
    }

    public function getSchedulesByTeacherId($teacher_id)
    {
        $schedules = DB::table('schedules')
            ->join('modules', 'schedules.module_id', '=', 'modules.module_id')
            ->join('classrooms', 'schedules.classroom_id', '=', 'classrooms.classroom_id')
            ->join('teachers', 'schedules.teacher_id', '=', 'teachers.teacher_id')
            ->join('teacher_types', 'teachers.teacher_type_id', '=', 'teacher_types.teacher_type_id')
            ->join('semesters', 'schedules.semester_id', '=', 'semesters.semester_id')
            ->where('schedules.teacher_id', '=', $teacher_id)
            ->select('schedules.*', 'modules.name as module_name', 'classrooms.classroom_code', 'teachers.fullname', 'teacher_types.teacher_type_id')
            ->get();


        if ($schedules->isEmpty()) {
            return response()->json(['status' => 'empty']);
        }

        return response()->json(['status' => 'success', 'events' => $schedules]);
    }


    public function generateUpdatedExcelTeachers($teacher_id, $templatePath = 'templates/emp_teacher.xls')
    {
        $response = $this->getSchedulesByTeacherId($teacher_id);

        if ($response->getData(true)['status'] !== 'success') {

            return $response;
        }

        $events = $response->getData(true)['events'];
        $namexls = 'Teacher' . $teacher_id . '.xlsx';

        $this->updateExcelTemplate($templatePath, $events, $namexls);

        return response()->download($namexls)->deleteFileAfterSend(true);
    }

    public function generateUpdatedExcel($department_id, $class_id, $year_id, $group_id, $templatePath = 'templates/emp.xls')
    {
        $response = $this->showSchedulesByYearByDepartmentClassesGroup($department_id, $class_id, $year_id, $group_id);

        //dd($response);

        if ($response->getData(true)['status'] !== 'success') {


            return $response;
        }

        $events = $response->getData(true)['events'];
        $namexls = 'Group' . $group_id . '.xlsx';

        $this->updateExcelTemplate($templatePath, $events, $namexls);

        return response()->download($namexls)->deleteFileAfterSend(true);
    }

    public function updateExcelTemplate($templatePath, $events, $namexls)
    {

        $spreadsheet = IOFactory::load($templatePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $newTimeSlotMap = ['Monday' => ['08:30 - 10:00' => ['module_name' => ['R8', 'S8', 'Q8'], 'classroom_code' => ['R9', 'S9', 'Q9'], 'teacher_fullname' => ['R10', 'S10', 'Q10'],], '10:00 - 11:30' => ['module_name' => ['O8', 'P8', 'N8'], 'classroom_code' => ['O9', 'P9', 'N9'], 'teacher_fullname' => ['O10', 'P10', 'N10'],], '11:30 - 13:00' => ['module_name' => ['L8', 'M8', 'K8'], 'classroom_code' => ['L9', 'M9', 'K9'], 'teacher_fullname' => ['L10', 'M10', 'K10'],], '13:30 - 15:00' => ['module_name' => ['H8', 'I8', 'G8'], 'classroom_code' => ['H9', 'I9', 'G9'], 'teacher_fullname' => ['H10', 'I10', 'G10'],], '15:00 - 16:30' => ['module_name' => ['E8', 'F8', 'D8'], 'classroom_code' => ['E9', 'F9', 'D9'], 'teacher_fullname' => ['E10', 'F10', 'D10'],], '16:30 - 18:00' => ['module_name' => ['B8', 'C8', 'A8'], 'classroom_code' => ['B9', 'C9', 'A9'], 'teacher_fullname' => ['B10', 'C10', 'A10'],],], 'Tuesday' => ['08:30 - 10:00' => ['module_name' => ['R11', 'S11', 'Q11'], 'classroom_code' => ['R12', 'S12', 'Q12'], 'teacher_fullname' => ['R13', 'S13', 'Q13'],], '10:00 - 11:30' => ['module_name' => ['O11', 'P11', 'N11'], 'classroom_code' => ['O12', 'P12', 'N12'], 'teacher_fullname' => ['O13', 'P13', 'N13'],], '11:30 - 13:00' => ['module_name' => ['L11', 'M11', 'K11'], 'classroom_code' => ['L12', 'M12', 'K12'], 'teacher_fullname' => ['L13', 'M13', 'K13'],], '13:30 - 15:00' => ['module_name' => ['H11', 'I11', 'G11'], 'classroom_code' => ['H12', 'I12', 'G12'], 'teacher_fullname' => ['H13', 'I13', 'G13'],], '15:00 - 16:30' => ['module_name' => ['E11', 'F11', 'D11'], 'classroom_code' => ['E12', 'F12', 'D12'], 'teacher_fullname' => ['E13', 'F13', 'D13'],], '16:30 - 18:00' => ['module_name' => ['B11', 'C11', 'A11'], 'classroom_code' => ['B12', 'C12', 'A12'], 'teacher_fullname' => ['B13', 'C13', 'A13'],],], 'Wednesday' => ['08:30 - 10:00' => ['module_name' => ['R14', 'S14', 'Q14'], 'classroom_code' => ['R15', 'S15', 'Q15'], 'teacher_fullname' => ['R16', 'S16', 'Q16'],], '10:00 - 11:30' => ['module_name' => ['O14', 'P14', 'N14'], 'classroom_code' => ['O15', 'P15', 'N15'], 'teacher_fullname' => ['O16', 'P16', 'N16'],], '11:30 - 13:00' => ['module_name' => ['L14', 'M14', 'K14'], 'classroom_code' => ['L15', 'M15', 'K15'], 'teacher_fullname' => ['L16', 'M16', 'K16'],], '13:30 - 15:00' => ['module_name' => ['H14', 'I14', 'G14'], 'classroom_code' => ['H15', 'I15', 'G15'], 'teacher_fullname' => ['H16', 'I16', 'G16'],], '15:00 - 16:30' => ['module_name' => ['E14', 'F14', 'D14'], 'classroom_code' => ['E15', 'F15', 'D15'], 'teacher_fullname' => ['E16', 'F16', 'D16'],], '16:30 - 18:00' => ['module_name' => ['B14', 'C14', 'A14'], 'classroom_code' => ['B15', 'C15', 'A15'], 'teacher_fullname' => ['B16', 'C16', 'A16'],],], 'Thursday' => ['08:30 - 10:00' => ['module_name' => ['R17', 'S17', 'Q17'], 'classroom_code' => ['R18', 'S18', 'Q18'], 'teacher_fullname' => ['R19', 'S19', 'Q19'],], '10:00 - 11:30' => ['module_name' => ['O17', 'P17', 'N17'], 'classroom_code' => ['O18', 'P18', 'N18'], 'teacher_fullname' => ['O19', 'P19', 'N19'],], '11:30 - 13:00' => ['module_name' => ['L17', 'M17', 'K17'], 'classroom_code' => ['L18', 'M18', 'K18'], 'teacher_fullname' => ['L19', 'M19', 'K19'],], '13:30 - 15:00' => ['module_name' => ['H17', 'I17', 'G17'], 'classroom_code' => ['H18', 'I18', 'G18'], 'teacher_fullname' => ['H19', 'I19', 'G19'],], '15:00 - 16:30' => ['module_name' => ['E17', 'F17', 'D17'], 'classroom_code' => ['E18', 'F18', 'D18'], 'teacher_fullname' => ['E19', 'F19', 'D19'],], '16:30 - 18:00' => ['module_name' => ['B17', 'C17', 'A17'], 'classroom_code' => ['B18', 'C18', 'A18'], 'teacher_fullname' => ['B19', 'C19', 'A19'],],], 'Friday' => ['08:30 - 10:00' => ['module_name' => ['R20', 'S20', 'Q20'], 'classroom_code' => ['R21', 'S21', 'Q21'], 'teacher_fullname' => ['R22', 'S22', 'Q22'],], '10:00 - 11:30' => ['module_name' => ['O20', 'P20', 'N20'], 'classroom_code' => ['O21', 'P21', 'N21'], 'teacher_fullname' => ['O22', 'P22', 'N22'],], '11:30 - 13:00' => ['module_name' => ['L20', 'M20', 'K20'], 'classroom_code' => ['L21', 'M21', 'K21'], 'teacher_fullname' => ['L22', 'M22', 'K22'],], '13:30 - 15:00' => ['module_name' => ['H20', 'I20', 'G20'], 'classroom_code' => ['H21', 'I21', 'G21'], 'teacher_fullname' => ['H22', 'I22', 'G22'],], '15:00 - 16:30' => ['module_name' => ['E20', 'F20', 'D20'], 'classroom_code' => ['E21', 'F21', 'D21'], 'teacher_fullname' => ['E22', 'F22', 'D22'],], '16:30 - 18:00' => ['module_name' => ['B20', 'C20', 'A20'], 'classroom_code' => ['B21', 'C21', 'A21'], 'teacher_fullname' => ['B22', 'C22', 'A22'],],], 'Saturday' => ['08:30 - 10:00' => ['module_name' => ['R23', 'S23', 'Q23'], 'classroom_code' => ['R24', 'S24', 'Q24'], 'teacher_fullname' => ['R25', 'S25', 'Q25'],], '10:00 - 11:30' => ['module_name' => ['O23', 'P23', 'N23'], 'classroom_code' => ['O24', 'P24', 'N24'], 'teacher_fullname' => ['O25', 'P25', 'N25'],], '11:30 - 13:00' => ['module_name' => ['L23', 'M23', 'K23'], 'classroom_code' => ['L24', 'M24', 'K24'], 'teacher_fullname' => ['L25', 'M25', 'K25'],], '13:30 - 15:00' => ['module_name' => ['H23', 'I23', 'G23'], 'classroom_code' => ['H24', 'I24', 'G24'], 'teacher_fullname' => ['H25', 'I25', 'G25'],], '15:00 - 16:30' => ['module_name' => ['E23', 'F23', 'D23'], 'classroom_code' => ['E24', 'F24', 'D24'], 'teacher_fullname' => ['E25', 'F25', 'D25'],], '16:30 - 18:00' => ['module_name' => ['B23', 'C23', 'A23'], 'classroom_code' => ['B24', 'C24', 'A24'], 'teacher_fullname' => ['B25', 'C25', 'A25'],],],];

        foreach ($newTimeSlotMap as $day => $timeSlots) {
            foreach ($timeSlots as $timeRange => $cellCoordinates) {

                [$rangeStart, $rangeEnd] = explode(' - ', $timeRange);

                // Find events for the current day and time slot
                $dayEvents = array_filter($events, function ($event) use ($day, $rangeStart, $rangeEnd) {
                    $startTime = substr($event['start_time'], 0, 5);
                    $endTime = substr($event['end_time'], 0, 5);

                    // Compare the times as time, not as strings
                    return $event['day_of_week'] === $day && $startTime >= $rangeStart && $endTime <= $rangeEnd;
                });


                foreach ($dayEvents as $event) {
                    foreach ($cellCoordinates as $element => $coordinates) {
                        if (isset($event[$element])) {
                            $cellValue = $event[$element];
                        }
                        sort($coordinates);
                        //dd($coordinates);
                        $startCoordinate = reset($coordinates);
                        // dd($startCoordinate);
                        $endCoordinate = end($coordinates);
                        $worksheet->mergeCells($startCoordinate . ':' . $endCoordinate);
                        $worksheet->setCellValue($startCoordinate, $cellValue);
                    }
                }
            }
        }



        // Save the modified Excel template
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($namexls);
    }

    // Function to get event information for the specified day and time range
    // private function getEventInfoForTimeSlot($events, $day, $timeRange)
    // {
    //     foreach ($events as $event) {
    //         $startTime = substr($event['start_time'], 0, 5);
    //         $endTime = substr($event['end_time'], 0, 5);

    //         // Check if the event matches the specified day and time range
    //         if ($event['day_of_week'] === $day && "$startTime - $endTime" === $timeRange) {
    //             return $event['module_name'] . "\n" . $event['classroom_code'] . "\n" . $event['teacher_fullname'];
    //         }
    //     }
    //     return ''; // Return empty string if no event is found
    // }




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

    public function reserveClass(Request $request)
    {
        $classroom_id = $request->input('classroom_id');
        $day_of_week = $request->input('day_of_week');
        $teacher_id = $request->input('teacher_id');
        $start_time = $request->input('start_time');
        $date = $request->input('date');
        $date = Carbon::createFromFormat('m/d/Y h:i A', $date)->format('Y-m-d H:i:s');
        $end_time = $request->input('end_time');

        $schedule = Schedule::where('classroom_id', $classroom_id)
            ->where('day_of_week', $day_of_week)
            ->where('start_time', $start_time)
            ->where('end_time', $end_time)
            ->first();

        if ($schedule && $schedule->isFull() && !$request->input('force')) {
            $group = $schedule->group;

            return response()->json([
                'status' => 'full',
                'message' => 'The schedule is full. The group filling the schedule is: ' . $group->name,
                'group' => $group
            ]);
        }

        $reservation = new Reservation;
        $reservation->classroom_id = $classroom_id;
        $reservation->teacher_id = $teacher_id;
        $reservation->date = $date;
        $reservation->save();

        return response()->json([
            'status' => 'success',
            'message' => 'The class has been reserved successfully.'
        ]);
    }
}
