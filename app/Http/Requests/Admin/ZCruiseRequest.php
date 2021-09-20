<?php

namespace App\Http\Requests\Admin;

use App\Models\ZPost;
use App\Models\ZProperty;
use Illuminate\Validation\Rule;

class ZCruiseRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $zProperties = ZProperty::getList();

        $rules = [
            'global_name' => 'required|string|max:50',
            'home_flg' => 'boolean',
            'z_property_id' => ['required', Rule::in($zProperties->pluck("id")->toArray())],

            'name' => 'required|string|max:50',
            'slug' => "required|string|max:50|" . $this->getUniqueRule("z_cruise_translations", 'slug'),
            'excerpt' => "nullable|string|max:1000",
            'description' => 'nullable|string',

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'required|string',
            'image.alt' => 'required|string',

            'images' => 'nullable|array',
            'images.*.url' => 'required|string',
            'images.*.alt' => 'required|string',
            'images.*.title' => 'required|string',
            'images.*.order_no' => 'required|numeric|min:0',

            'key_facts' => 'nullable|array',
            'key_facts.*.url' => 'nullable|string',
            'key_facts.*.alt' => 'nullable|required_with:key_facts.*.url|string',
            'key_facts.*.title' => 'nullable|required_with:key_facts.*.url|string',
            'key_facts.*.order_no' => 'nullable|numeric|min:0',

            'z_post_ids' => 'array',
            'z_post_ids.*' => [Rule::in(ZPost::getListByType(ZPost::TYPE_EXPERIENCE)->pluck("id")->toArray())],
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
