<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'bio'            => $this->bio,
            'skills_summary' => $this->skills_summary,
            'hourly_rate'    => $this->hourly_rate,
            'user'           => new UserResource($this->whenLoaded('user')),
        ];
    }
}

