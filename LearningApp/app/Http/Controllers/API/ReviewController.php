<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        $user  = $request->user();
        $data  = $request->validated();
        $order = Order::with(['freelancer', 'client'])->findOrFail($data['order_id']);

        if ($order->status !== 'completed') {
            throw ValidationException::withMessages([
                'order_id' => ['You can only review completed orders.'],
            ]);
        }

        if ($order->client_id !== $user->id) {
            throw ValidationException::withMessages([
                'order_id' => ['You are not the client of this order.'],
            ]);
        }

        $review = Review::create([
            'order_id'      => $order->id,
            'client_id'     => $order->client_id,
            'freelancer_id' => $order->freelancer_id,
            'rating'        => $data['rating'],
            'comment'       => $data['comment'] ?? null,
        ]);

        $review->load(['client', 'freelancer']);

        return response()->json(new ReviewResource($review), 201);
    }
}

