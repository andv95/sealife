<?php

namespace App\Http\Requests\Admin;

use App\Models\Page;
use Illuminate\Validation\Rule;

class PageRequest extends AdminBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $fixedPage = false;
        if (($id = $this->route("id")) && ($page = Page::getById($id))) {
            $fixedPage = $page->isFixedPage();
        }

        $rules = [
            'global_name' => 'required|string|max:50',
        ];

        if (!$fixedPage) {

            $rules = array_merge($rules, [
                'view_name' => ["nullable", "string", "max:255", Rule::in(Page::VIEW_NAMES)],

                'name' => 'required|string|max:255',
                'slug' => "required|string|max:255|" . $this->getUniqueRule("page_translations", 'slug'),

                'titles' => "nullable|array",
                'titles.*' => "nullable|string",

                'images' => 'nullable|array',
                'images.*.url' => 'nullable|string',
                'images.*.alt' => 'nullable|string',
                'images.*.title' => 'nullable|string',
                'images.*.order_no' => 'nullable|numeric|min:0',

                'contents' => "nullable|array",
                'contents.*' => "nullable|string",
            ]);

            $rules = $this->addActiveFlgRules($rules);
        }

        $rules = $this->addSeoRules($rules);

        return $rules;
    }
}
