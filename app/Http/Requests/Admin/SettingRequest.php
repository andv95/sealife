<?php

namespace App\Http\Requests\Admin;

use App\Models\Setting;
use Illuminate\Validation\Rule;

class SettingRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "key" => "required|string|max:20|" . $this->getUniqueRule("settings", "key"),
            "display_name" => "required|string|max:50",
            "type" => ["required", Rule::in(Setting::ALL_TYPES)],
            "group" => ["required", Rule::in(Setting::ALL_GROUPS), "max:20", "string"],
            "order_no" => ["nullable", "numeric", "min:0"]
        ];
    }
}
