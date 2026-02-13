<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\StoreRequest;
use App\Http\Requests\Job\UpdateRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $jobs = Job::with('client')
            ->latest()
            ->paginate($request->get('per_page', 15));

        return response()->json(
            JobResource::collection($jobs)->response()->getData(true)
        );
    }

    public function show(Job $job): JsonResponse
    {
        $job->load('client');

        return response()->json(new JobResource($job));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $job = Job::create([
            'client_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        $job->load('client');

        return response()->json(new JobResource($job), 201);
    }

    public function update(UpdateRequest $request, Job $job): JsonResponse
    {
        $job->update($request->validated());
        $job->load('client');

        return response()->json(new JobResource($job));
    }

    public function destroy(Request $request, Job $job): JsonResponse
    {
        $this->authorize('delete', $job);

        $job->delete();

        return response()->json([], 204);
    }
}

