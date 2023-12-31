<?php

namespace App\Http\Controllers;

use App\Models\CronLog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CronLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('cron-log/index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CronLog $cronLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CronLog $cronLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CronLog $cronLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CronLog $cronLog)
    {
        //
    }

    public function getLogs()
    {
        return response()->json(CronLog::query()->latest()->take(10)->orderBy('updated_at', 'desc')->with(['status','scheduler'])->get());
    }
}
