<?php

namespace App\Http\Requests\Job;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var Job $job */
        $job = $this->route('job');

        return $this->user()?->can('update', $job) ?? false;
    }

    public function rules(): array
    {
        return [
            'title'       => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'budget'      => ['sometimes', 'numeric', 'min:0'],
            'status'      => ['sometimes', 'in:open,in_progress,completed'],
        ];
    }
}

