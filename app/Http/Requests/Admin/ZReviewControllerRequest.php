<?php

namespace App\Http\Requests\Admin;

use App\Models\ZPost;
use App\Models\ZProperty;
use Illuminate\Validation\Rule;

class ZReviewControllerRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'global_name' => 'required|string|max:50',
            'home_flg' => 'boolean',

            'name' => 'required|string|max:255',
            'author' => "required|string|max:50|",
            'rating' => "nullable|numeric|max:1000",
            'review_date' => 'nullable|date',
            'content' => 'nullable|string',

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'nullable|string',
            'image.alt' => 'nullable|string',
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
