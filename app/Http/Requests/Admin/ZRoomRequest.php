<?php

namespace App\Http\Requests\Admin;

use App\Models\ZCruise;
use App\Models\ZProperty;
use App\Models\ZRoom;
use Illuminate\Validation\Rule;

class ZRoomRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $zCruises = ZCruise::getList();

        $rules = [
            'global_name' => 'required|string|max:50',
            'max_guest_no' => 'required|numeric|min:1|max:99',
            'z_cruise_id' => ['required', Rule::in($zCruises->pluck("id")->toArray())],

            'api_id' => ["nullable", Rule::in(ZRoom::getApiIds()->pluck("id_random")->toArray())],

            'name' => 'required|string|max:50',
            /*'slug' => "required|string|max:50|" . $this->getUniqueRule("z_room_translations", 'slug'),*/
            'size' => 'required|string|max:50',
            'price' => 'required|string|max:50',

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'nullable|required_with:image.url|string',
            'image.alt' => 'nullable|required_with:image.url|string',

            'images' => 'nullable|array',
            'images.*.url' => 'nullable|string',
            'images.*.alt' => 'nullable|required_with:images.*.url|string',
            'images.*.title' => 'nullable|required_with:images.*.url|string',
            'images.*.order_no' => 'nullable|numeric|min:0',

            'key_facts' => 'nullable|array',
            'key_facts.*.url' => 'nullable|string',
            'key_facts.*.alt' => 'nullable|required_with:key_facts.*.url|string',
            'key_facts.*.title' => 'nullable|required_with:key_facts.*.url|string',
            'key_facts.*.order_no' => 'nullable|numeric|min:0',
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
