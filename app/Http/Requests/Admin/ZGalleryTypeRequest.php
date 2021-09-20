<?php

namespace App\Http\Requests\Admin;

use App\Models\ZGalleryType;
use App\Models\ZNewsType;
use Illuminate\Validation\Rule;

class ZGalleryTypeRequest extends AdminBaseRequest
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
            'parent_id' => ['nullable', Rule::in(ZGalleryType::getList()->pluck("id")->toArray())],

            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|" . $this->getUniqueRule("z_gallery_type_translations", 'slug'),
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
