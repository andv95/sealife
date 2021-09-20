<?php

namespace App\Http\Requests\Admin;

use App\Models\ZPackage;
use Illuminate\Validation\Rule;

class ZTransferRequest extends AdminBaseRequest
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
            'order' => 'nullable|numeric|max:99|min:0',

            'name' => 'required|string|max:50',

            'z_package_ids' => 'array',
            'z_package_ids.*' => [Rule::in(ZPackage::getList()->pluck("id")->toArray())],
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
