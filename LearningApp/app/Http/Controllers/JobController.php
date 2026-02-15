<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\StoreRequest;
use App\Http\Requests\Job\UpdateRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of jobs.
     */
    public function index(Request $request)
    {
        $jobs = Job::with('client')
            ->latest()
            ->paginate(15);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        
        return view('jobs.create');
    }

    /**
     * Store a newly created job in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Job::class);

        $job = Job::create([
            'client_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job posted successfully');
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified job in storage.
     */
    public function update(UpdateRequest $request, Job $job)
    {
        $this->authorize('update', $job);

        $job->update($request->validated());

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified job from storage.
     */
    public function destroy(Request $request, Job $job)
    {
        $this->authorize('delete', $job);

        $job->delete();

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}
