<?php

namespace App\Http\Requests\Admin;

use App\Models\ZNewsType;
use App\Models\ZPackage;
use Illuminate\Validation\Rule;

class ZNewsPostRequest extends AdminBaseRequest
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
            'featured1_flg' => 'boolean',
            'featured2_flg' => 'boolean',
            'z_news_type_ids' => "required|array",
            'z_news_type_ids.*' => ["required", Rule::in(ZNewsType::getList()->pluck("id")->toArray())],

            'z_package_ids' => "nullable|array",
            'z_package_ids.*' => ["required", Rule::in(ZPackage::getList()->pluck("id")->toArray())],

            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|" . $this->getUniqueRule("z_news_post_translations", 'slug'),
            'excerpt' => "required|string",
            'content' => "required|string",

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'required|string',
            'image.alt' => 'required|string',

            'featured1_image' => 'nullable|array',
            'featured1_image.url' => 'nullable|string',
            'featured1_image.title' => 'nullable|required_with:featured1_image.url|string',
            'featured1_image.alt' => 'nullable|required_with:featured1_image.url|string',

            'featured2_image' => 'nullable|array',
            'featured2_image.url' => 'nullable|string',
            'featured2_image.title' => 'nullable|required_with:featured2_image.url|string',
            'featured2_image.alt' => 'nullable|required_with:featured2_image.url|string',
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
