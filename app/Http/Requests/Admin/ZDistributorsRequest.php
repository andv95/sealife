<?php

namespace App\Http\Requests\Admin;

use App\Models\ZDestination;
use Illuminate\Validation\Rule;

class ZDistributorsRequest extends AdminBaseRequest
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

            'name' => 'required|string|max:255',
            'phone' => "required|string|max:255|",
            'email' => "required|string|max:255",
            'address' => "required|string|max:255",
        ];

        $rules = $this->addActiveFlgRules($rules);


        return $rules;
    }
}
