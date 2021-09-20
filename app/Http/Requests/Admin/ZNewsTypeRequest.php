<?php

namespace App\Http\Requests\Admin;

use App\Models\ZNewsType;
use Illuminate\Validation\Rule;

class ZNewsTypeRequest extends AdminBaseRequest
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
            'order_no' => 'nullable|numeric|min:0|max:999',
            'parent_id' => ['nullable', Rule::in(ZNewsType::getList()->pluck("id")->toArray())],

            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|" . $this->getUniqueRule("z_news_type_translations", 'slug'),

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'required|string',
            'image.alt' => 'required|string',

            'banner_image' => 'required|array',
            'banner_image.url' => 'required|string',
            'banner_image.title' => 'required|string',
            'banner_image.alt' => 'required|string',
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
