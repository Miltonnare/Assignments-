<?php

namespace App\Http\Requests\FreelancerProfile;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isFreelancer() ?? false;
    }

    public function rules(): array
    {
        return [
            'bio'            => ['nullable', 'string'],
            'skills_summary' => ['nullable', 'string'],
            'hourly_rate'    => ['nullable', 'numeric', 'min:0'],
        ];
    }
}

