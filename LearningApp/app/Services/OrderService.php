<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function createOrder(User $client, Service $service): Order
    {
        if ($service->user_id === $client->id) {
            throw ValidationException::withMessages([
                'service_id' => ['You cannot order your own service.'],
            ]);
        }

        return Order::create([
            'service_id'    => $service->id,
            'client_id'     => $client->id,
            'freelancer_id' => $service->user_id,
            'amount'        => $service->price,
            'status'        => 'pending',
        ]);
    }
}

