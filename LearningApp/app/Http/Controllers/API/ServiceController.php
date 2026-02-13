<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $services = Service::with('freelancer')
            ->latest()
            ->paginate($request->get('per_page', 15));

        return response()->json(
            ServiceResource::collection($services)->response()->getData(true)
        );
    }

    public function show(Service $service): JsonResponse
    {
        $service->load('freelancer');

        return response()->json(new ServiceResource($service));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $service = Service::create([
            'user_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        $service->load('freelancer');

        return response()->json(new ServiceResource($service), 201);
    }

    public function update(UpdateRequest $request, Service $service): JsonResponse
    {
        $service->update($request->validated());
        $service->load('freelancer');

        return response()->json(new ServiceResource($service));
    }

    public function destroy(Request $request, Service $service): JsonResponse
    {
        $this->authorize('delete', $service);

        $service->delete();

        return response()->json([], 204);
    }
}

