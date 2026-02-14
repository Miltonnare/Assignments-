<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreelancerProfile\StoreUpdateRequest;
use App\Http\Resources\FreelancerProfileResource;
use Illuminate\Http\JsonResponse;

class FreelancerProfileController extends Controller
{
    public function show(): JsonResponse
    {
        $user = auth()->user()->load('freelancerProfile');
        $profile = $user->freelancerProfile;

        if (! $profile) {
            return response()->json(['data' => null], 200);
        }

        return response()->json(new FreelancerProfileResource($profile));
    }

    public function storeOrUpdate(StoreUpdateRequest $request): JsonResponse
    {
        $user = $request->user();

        $profile = $user->freelancerProfile()
            ->updateOrCreate(
                ['user_id' => $user->id],
                $request->validated()
            );

        return response()->json(
            new FreelancerProfileResource($profile),
            200
        );
    }
}

