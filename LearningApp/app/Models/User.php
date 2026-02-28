<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_CLIENT = 'client';
    public const ROLE_FREELANCER = 'freelancer';
    public const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }

    public function isFreelancer(): bool
    {
        return $this->role === self::ROLE_FREELANCER;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function freelancerProfile()
    {
        return $this->hasOne(FreelancerProfile::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'client_id');
    }

    public function clientOrders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    public function freelancerOrders()
    {
        return $this->hasMany(Order::class, 'freelancer_id');
    }

    public function clientReviews()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function freelancerReviews()
    {
        return $this->hasMany(Review::class, 'freelancer_id');
    }
}
