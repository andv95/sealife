<?php

namespace App\Http\Requests\Admin;

class ZPropertyRequest extends AdminBaseRequest
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
            'home_flg' => 'boolean',

            'name' => 'required|string|max:50',
            'slug' => "required|string|max:50|" . $this->getUniqueRule("z_property_translations", 'slug'),
            'excerpt' => "required|string|max:1000",
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
