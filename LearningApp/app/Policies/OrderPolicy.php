<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isClient() || $user->isFreelancer() || $user->isAdmin();
    }

    public function view(User $user, Order $order): bool
    {
        return $user->isAdmin()
            || $order->client_id === $user->id
            || $order->freelancer_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isClient() || $user->isAdmin();
    }

    public function updateStatus(User $user, Order $order): bool
    {
        return $this->view($user, $order);
    }
}

