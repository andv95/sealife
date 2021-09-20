<?php

namespace App\Http\Requests\Admin;

class MenuRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "name" => "required|string|max:50|" . $this->getUniqueRule("menus", "name"),
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
