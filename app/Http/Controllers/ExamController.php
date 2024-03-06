<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Exam::all();
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
    public function store(StoreExamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $distinctTimes = Exam::where('day', '2023-07-11')
            ->select('start_time', 'end_time')
            ->distinct()->get();

        if ($distinctTimes == null) {
            return [];
        }

        return $distinctTimes;
    }


    /**
     * Display a distinct listing of distinctTimes by Specific day.
     */
    public function distinctTimes(Request $request): JsonResponse
    {
        $day = $request->input('day');

        if ($day == '') {
            return response()->json([]);
        }

        $distinctTimes = Exam::where('day', $day)
            ->select('start_time', 'end_time')
            ->distinct()->get();

        if ($distinctTimes->isEmpty()) {
            return response()->json([]);
        }

        return response()->json($distinctTimes);
    }

    /**
     * Display a distinct listing of distinctTimes by Specific day.
     */
    public function distinctTimesView(Request $request)
    {
        $day = $request->input('day');

        if ($day == '') {
            return response()->json([]);
        }

        $distinctTimes = Exam::where('day', $day)
            ->select('start_time', 'end_time')
            ->distinct()->get();

        if ($distinctTimes->isEmpty()) {
            return response()->json([]);
        }

        return view('components.parts.distinctTimes')->with("distinctTimes", $distinctTimes);
    }

    /**
     * Display a distinct listing of distinctDays.
     */
    public function distinctDays(Request $request): JsonResponse
    {
        $distinctDays = DB::table('exams AS T1')->select('T1.day')->distinct(['T1.day'])->get();

        if ($distinctDays->isEmpty()) {
            return response()->json([]);
        }

        return response()->json($distinctDays);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
