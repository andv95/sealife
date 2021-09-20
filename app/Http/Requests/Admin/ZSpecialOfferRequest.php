<?php

namespace App\Http\Requests\Admin;

class ZSpecialOfferRequest extends AdminBaseRequest
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
            'order_no' => 'nullable|numeric|min:0|max:99',

            'name' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'invalid_desc' => 'required|string|max:500',
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
