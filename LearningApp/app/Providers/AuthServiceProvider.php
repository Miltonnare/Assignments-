<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\Order;
use App\Models\Service;
use App\Policies\JobPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ServicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Service::class => ServicePolicy::class,
        Job::class     => JobPolicy::class,
        Order::class   => OrderPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}

