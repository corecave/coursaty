<?php

namespace App\Http\Requests\Site;

use App\Http\Requests\JsonFormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'author' => ['required'],
            'description' => ['nullable', 'max:2000'],
            'hours' => ['required', 'integer'],
            'views' => ['required', 'integer'],
            'rating' => ['required', 'integer'],
            'level' => ['required', Rule::in(['beginner', 'immediate', 'high'])],
            'active' => ['required', Rule::in(['1', '0'])],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ];
    }
}
