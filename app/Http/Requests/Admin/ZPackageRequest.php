<?php

namespace App\Http\Requests\Admin;

use App\Models\ZCruise;
use App\Models\ZDestination;
use App\Models\ZDuration;
use App\Models\ZOffer;
use App\Models\ZPackage;
use App\Models\ZPost;
use App\Models\ZProperty;
use Illuminate\Validation\Rule;

class ZPackageRequest extends AdminBaseRequest
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
            'api_id' => ["nullable", Rule::in(ZPackage::getApiIds()->pluck("id_random")->toArray())],

            'name' => 'required|string|max:50',
            'order_no' => 'nullable|numeric|max:9999|min:0',
            'slug' => "required|string|max:50|" . $this->getUniqueRule("z_package_translations", 'slug'),

            'z_cruise_id' => ['required', Rule::in(ZCruise::getList()->pluck("id")->toArray())],
            'z_duration_id' => ['required', Rule::in(ZDuration::getList()->pluck("id")->toArray())],

            'z_offer_ids' => 'array',
            'z_offer_ids.*' => [Rule::in(ZOffer::getList()->pluck("id")->toArray())],

            'z_destination_ids' => 'array',
            'z_destination_ids.*' => [Rule::in(ZDestination::getList()->pluck("id")->toArray())],

            'z_post_ids' => 'array',
            'z_post_ids.*' => [Rule::in(ZPost::getListByType(ZPost::TYPE_ACTIVITY)->pluck("id")->toArray())],

            'itinerary_file' => "nullable|string|max:255",

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'required|string',
            'image.alt' => 'required|string',

            'itinerary_bg_image' => 'nullable|array',
            'itinerary_bg_image.url' => 'nullable|string',
            'itinerary_bg_image.title' => 'nullable|string',
            'itinerary_bg_image.alt' => 'nullable|string',

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
