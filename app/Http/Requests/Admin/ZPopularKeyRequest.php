<?php

namespace App\Http\Requests\Admin;

use App\Models\ZPost;
use App\Models\ZProperty;
use Illuminate\Validation\Rule;

class ZPopularKeyRequest extends AdminBaseRequest
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

            'name' => 'required|string|max:255',
            'url' => "required|string|max:255|",

        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
