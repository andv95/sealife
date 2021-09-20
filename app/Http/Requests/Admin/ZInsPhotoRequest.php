<?php

namespace App\Http\Requests\Admin;

use App\Models\ZInsPhoto;
use Illuminate\Validation\Rule;

class ZInsPhotoRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!$this->route("id")) {
            return [
                "tag" => "required|string|max:100",
            ];
        }

        $rules = [
            'position_no' => [
                "nullable",
                Rule::in(ZInsPhoto::NO_POSITIONS),
                $this->getUniqueRule("z_ins_photos", "position_no")
            ],
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
