<?php

namespace App\Http\Requests\Admin;

class ZDurationRequest extends AdminBaseRequest
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
            'point' => 'required|numeric|min:0|max:100',
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
