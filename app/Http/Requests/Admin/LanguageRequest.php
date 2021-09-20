<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $supportedLocales = Language::getPackageLanguageKeys();

        $rules = [
            'language_key' => [
                'required', 'string', 'max:10',
                $this->getUniqueRule("languages", "language_key"),
                Rule::in($supportedLocales)
            ],
            'native_name' => 'required|string|max:20',
            'latin_name' => 'nullable|string|max:20',
            'script' => 'nullable|string|max:20',
            'regional' => 'nullable|string|max:10',
            'order_no' => 'nullable|numeric|min:0|max:99',
            'remark' => 'nullable|string|max:500'
        ];

        $rules = $this->addActiveFlgRules($rules);

        return $rules;
    }
}
