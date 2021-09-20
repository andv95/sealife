<?php

namespace App\Http\Requests\Admin;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Validation\Rule;

class MenuItemRequest extends AdminBaseRequest
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
            'menu_id' => ['required', Rule::in(Menu::getList()->pluck("id")->toArray())],

            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'open_target' => ["required", Rule::in(MenuItem::OPEN_TARGETS)],
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
