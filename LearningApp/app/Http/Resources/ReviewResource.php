<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'rating'     => $this->rating,
            'comment'    => $this->comment,
            'client'     => new UserResource($this->whenLoaded('client')),
            'freelancer' => new UserResource($this->whenLoaded('freelancer')),
            'order_id'   => $this->order_id,
            'created_at' => $this->created_at,
        ];
    }
}

