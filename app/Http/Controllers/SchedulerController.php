<?php

namespace App\Http\Controllers;

use DateTimeZone;
use Inertia\Inertia;
use App\Models\Scheduler;
use Illuminate\Http\Request;
use App\Services\SchedulerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SchedulerCreateRequest;
use App\Http\Requests\SchedulerUpdateRequest;

class SchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('scheduler/index');
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
    public function store(SchedulerCreateRequest $request)
    {
        $schedulerService = new SchedulerService();
        $scheduler = $schedulerService->create($request->all());
        $scheduler->addFrequencies($request->get("frequencies"));

        return Redirect::route('schedulers.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Scheduler $scheduler)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scheduler $scheduler)
    {
        $scheduler->frequencies;
        return Inertia::render('scheduler/edit', ['scheduler' => $scheduler]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchedulerUpdateRequest $request, Scheduler $scheduler)
    {
        $schedulerService = new SchedulerService($scheduler);
        $scheduler = $schedulerService->update($request->all());
        $scheduler->addFrequencies($request->get("frequencies"));

        return Redirect::route('schedulers.edit', $scheduler->uuid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scheduler $scheduler)
    {
        //
    }

    public function toggleActive(Scheduler $scheduler)
    {
        $scheduler->toggleActive();
    }

    public function getCronJobs()
    {
        $folderPath = app_path('/Jobs');
        $fileNames = [];

        if (File::isDirectory($folderPath)) {
            $files = File::files($folderPath);
            $fileNames = array_map(fn ($f) => pathinfo($f, PATHINFO_FILENAME), $files);
            $fileNames = array_values(array_filter($fileNames, fn ($f) => $f != "CronJob"));
        }

        return response()->json($fileNames);
    }

    public function getTimezones()
    {
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        return response()->json($timezones);
    }

    public function getSchedulers()
    {
        $schedulers = Scheduler::query()->with('frequencies')->get();
        return  response()->json($schedulers);
    }
}
