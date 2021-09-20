<?php

namespace App\Http\Requests\Admin;

class ZOfferRequest extends AdminBaseRequest
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

            'name' => 'required|string|max:50',
            'image' => 'required|array',
            'image.url' => 'required|string',
            'image.title' => 'nullable|string',
            'image.alt' => 'nullable|string',
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
