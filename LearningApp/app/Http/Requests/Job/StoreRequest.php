<?php

namespace App\Http\Requests\Job;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', Job::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'budget'      => ['required', 'numeric', 'min:0'],
            'status'      => ['sometimes', 'in:open,in_progress,completed'],
        ];
    }
}

