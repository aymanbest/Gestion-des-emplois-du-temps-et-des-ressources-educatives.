<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::all(['group_id', 'group_code']);
        return response()->json($groups);
    }

    public function getGroupsByDepartmentAndClass($departmentId, $classId) {
        // Query the groups table
        $groups = DB::table('groups')
        ->join('schedules', 'groups.group_id', '=', 'schedules.group_id') // Join with the schedules table
        ->join('classes', 'schedules.class_id', '=', 'classes.class_id') // Join with the classes table
        ->where('classes.department_id', $departmentId) // Filter by department_id in classes table
        ->where('classes.class_id', $classId) // Filter by class_id in classes table
        ->select('groups.group_id', 'groups.group_code') // Select group_id and group_code
        ->distinct() // Remove duplicates
        ->get();
    
        // Return the result as a JSON response
        return response()->json($groups);
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
    public function store(StoreGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
