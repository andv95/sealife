<?php

namespace App\Http\Requests\Admin;

use App\Models\ZDestination;
use Illuminate\Validation\Rule;

class ZDestinationRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $zDestinations = ZDestination::getEloquentList()->active()->get();

        $rules = [
            'global_name' => 'required|string|max:50',

            'z_destination_id' => ['nullable', Rule::in($zDestinations->pluck("id")->toArray())],
            'name' => 'required|string|max:50',
            'slug' => "required|string|max:50|" . $this->getUniqueRule("z_destination_translations", 'slug'),
            'summary' => "nullable|string",
            'description' => "nullable|string",
        ];

        $rules = $this->addActiveFlgRules($rules);
        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
