<?php

namespace App\Http\Requests\Site;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'notes' => ['nullable', 'max:2000'],
            'active' => ['required', Rule::in(['1', '0'])],
        ];
    }
}
