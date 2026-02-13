<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'status'     => $this->status,
            'amount'     => $this->amount,
            'service'    => new ServiceResource($this->whenLoaded('service')),
            'client'     => new UserResource($this->whenLoaded('client')),
            'freelancer' => new UserResource($this->whenLoaded('freelancer')),
            'review'     => new ReviewResource($this->whenLoaded('review')),
            'created_at' => $this->created_at,
        ];
    }
}

