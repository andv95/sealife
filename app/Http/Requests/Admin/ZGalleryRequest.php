<?php

namespace App\Http\Requests\Admin;

use App\Models\ZGalleryType;
use Illuminate\Validation\Rule;

class ZGalleryRequest extends AdminBaseRequest
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
            'z_gallery_type_id' => "required",
            'z_gallery_type_id.*' => ["required", Rule::in(ZGalleryType::getList()->pluck("id")->toArray())],

            'images' => 'nullable|array',
            'images.*.url' => 'required|string',
            'images.*.alt' => 'required|string',
            'images.*.title' => 'required|string',
            'images.*.order_no' => 'required|numeric|min:0',
            'images.*.video_url' => 'nullable|string',

            'images_mobile' => 'nullable|array',
            'images_mobile.*.url' => 'nullable|string',
            'images_mobile.*.alt' => 'nullable|required_with:images_mobile.*.url|string',
            'images_mobile.*.title' => 'nullable|required_with:images_mobile.*.url|string',
            'images_mobile.*.order_no' => 'nullable|numeric|min:0',
            'images_mobile.*.video_url' => 'nullable|string',

        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
