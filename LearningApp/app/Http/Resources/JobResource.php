<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'budget'      => $this->budget,
            'status'      => $this->status,
            'client'      => new UserResource($this->whenLoaded('client')),
            'created_at'  => $this->created_at,
        ];
    }
}

