<?php

namespace App\Http\Requests\Admin;

use App\Models\ZPost;
use Illuminate\Validation\Rule;

class ZPostRequest extends AdminBaseRequest
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

            'name' => 'required|string|max:50',
            'slug' => "required|string|max:50|" . $this->getUniqueRule("z_post_translations", 'slug'),
            'excerpt' => "nullable|string|max:1000",
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(ZPost::TYPES)],

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'nullable|string',
            'image.alt' => 'nullable|string',

            'images' => 'nullable|array',
            'images.*.url' => 'required|string',
            'images.*.alt' => 'required|string',
            'images.*.title' => 'required|string',
            'images.*.order_no' => 'required|numeric|min:0',
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
