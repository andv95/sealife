<?php

namespace App\Http\Requests\Admin;

use App\Models\ZBanner;
use App\Models\ZProperty;
use Illuminate\Validation\Rule;

class ZBannerRequest extends AdminBaseRequest
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
            'type' => ['required', Rule::in(ZBanner::TYPES)],

            'images' => 'array',
            'images.*.url' => 'required|string',
            'images.*.alt' => 'required|string',
            'images.*.title' => 'required|string',
            'images.*.order_no' => 'required|numeric|min:0',

            'images_mobile' => 'array',
            'images_mobile.*.url' => 'required|string',
            'images_mobile.*.alt' => 'required|string',
            'images_mobile.*.title' => 'required|string',
            'images_mobile.*.order_no' => 'required|numeric|min:0',

            'video_url' => "nullable|string|max:255",
            'video_url_mobile' => "nullable|string|max:255",
            'view_more_url' => "nullable|string|max:255",
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
