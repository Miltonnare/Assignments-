<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreRequest;
use App\Models\Order;
use App\Models\Service;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Order::with(['service', 'client', 'freelancer', 'review']);

        if (! $user->isAdmin()) {
            $query->where(function ($q) use ($user) {
                $q->where('client_id', $user->id)
                    ->orWhere('freelancer_id', $user->id);
            });
        }

        $orders = $query->latest()->paginate(15);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Request $request, Order $order)
    {
        $this->authorize('view', $order);

        $order->load(['service', 'client', 'freelancer', 'review']);

        return view('orders.show', compact('order'));
    }

    /**
     * Store a newly created order.
     */
    public function store(StoreRequest $request, Service $service)
    {
        $order = $this->orderService->createOrder(
            $request->user(),
            $service
        );

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Order created successfully');
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $this->authorize('updateStatus', $order);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,active,completed,cancelled'],
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Order status updated successfully');
    }
}
