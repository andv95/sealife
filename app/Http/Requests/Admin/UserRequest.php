<?php

namespace App\Http\Requests\Admin;

class UserRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isEdit = !!$this->route("id");

        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50|' . $this->getUniqueRule("users", "email"),
            'password' => 'string|min:4|max:20',
        ];

        if ($isEdit) {
            $rules["password"] .= "|nullable";
        } else {
            $rules["password"] .= "|required";
        }

        return $rules;
    }
}
