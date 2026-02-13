<?php

namespace App\Http\Requests\Service;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var Service $service */
        $service = $this->route('service');

        return $this->user()?->can('update', $service) ?? false;
    }

    public function rules(): array
    {
        return [
            'title'         => ['sometimes', 'string', 'max:255'],
            'description'   => ['sometimes', 'string'],
            'price'         => ['sometimes', 'numeric', 'min:0'],
            'delivery_days' => ['sometimes', 'integer', 'min:1'],
        ];
    }
}

