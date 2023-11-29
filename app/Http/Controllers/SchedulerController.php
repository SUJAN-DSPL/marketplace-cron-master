<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Scheduler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('scheduler/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log::channel('scheduler_create_logs')->info('New user logged in',  [
        //     'label' => 'Between',
        //     'method' => 'between',
        //     'params_details' => [
        //         [
        //             'name' => 'startTime',
        //             'description' => 'Specify the start time',
        //             'rules' => [['required', 'string']]
        //         ],
        //         [
        //             'name' => 'endTime',
        //             'description' => 'Specify the end time',
        //             'rules' => [['required', 'string']]
        //         ],
        //     ],
        //     'is_active' => true,
        //     'description' => 'Limit the task to run between start and end times'
        // ]);

        $logFilePath = app_path('Logs/scheduler_create.log');

        // if (File::exists($logFilePath)) {
        //     $logContent = File::get($logFilePath);
        //     $logLines = explode("\n", $logContent);

        //     $logContexts = [];

        //     foreach ($logLines as $line) {
        //         $jsonStartPos = strpos($line, '{');
        //         if ($jsonStartPos !== false) {
        //             $jsonString = substr($line, $jsonStartPos);
        //             $logContexts[] = json_decode($jsonString, true);
        //         }
        //     }
        //     dd($logContexts);
        // } else {
        //     dd("Log file not found or channel doesn't exist.");
        // }

        $data = [
            'cron_job_id' => 1,
            'time'
        ];


        // return response()->json(["hello"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Scheduler $scheduler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scheduler $scheduler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scheduler $scheduler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scheduler $scheduler)
    {
        //
    }
}
