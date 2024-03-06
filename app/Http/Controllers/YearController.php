<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Http\Requests\StoreYearRequest;
use App\Http\Requests\UpdateYearRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years = Year::all(['year_id', 'year']);
        return response()->json($years);
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
    public function store(StoreYearRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HttpRequest $request)
    {
        //dd($request->year);
        $years = Year::where('year', $request->year)->first();
       //dd($years);
        return response()->json(['id' => $years->year_id]);
    }
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Year $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateYearRequest $request, Year $year)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        //
    }
}
