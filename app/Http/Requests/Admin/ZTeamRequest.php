<?php

namespace App\Http\Requests\Admin;

use App\Models\ZBanner;
use App\Models\ZProperty;
use Illuminate\Validation\Rule;

class ZTeamRequest extends AdminBaseRequest
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
            'branch' => "nullable|numeric",

            'name' => 'required|string|max:255',
            'position' => "required|string|max:50|",
            'content' => 'nullable|string',

            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'nullable|string',
            'image.alt' => 'nullable|string',
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
