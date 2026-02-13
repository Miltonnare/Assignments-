<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Service;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = Order::with(['service', 'client', 'freelancer', 'review']);

        if (! $user->isAdmin()) {
            $query->where(function ($q) use ($user) {
                $q->where('client_id', $user->id)
                    ->orWhere('freelancer_id', $user->id);
            });
        }

        $orders = $query->latest()->paginate($request->get('per_page', 15));

        return response()->json(
            OrderResource::collection($orders)->response()->getData(true)
        );
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        $this->authorize('view', $order);

        $order->load(['service', 'client', 'freelancer', 'review']);

        return response()->json(new OrderResource($order));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $service = Service::findOrFail($request->validated()['service_id']);

        $order = $this->orderService->createOrder(
            $request->user(),
            $service
        );

        $order->load(['service', 'client', 'freelancer']);

        return response()->json(new OrderResource($order), 201);
    }

    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $this->authorize('updateStatus', $order);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,active,completed,cancelled'],
        ]);

        $order->update(['status' => $validated['status']]);
        $order->load(['service', 'client', 'freelancer', 'review']);

        return response()->json(new OrderResource($order));
    }
}

