<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminBaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getUniqueRule(string $table, string $field, int $id = null)
    {
        if (is_null($id)) {
            $id = $this->route("id");

            if (Str::contains($table, "translations")) {
                $parentField = Str::replaceFirst("translations", "", $table);
                $parentField .= "id";

                $localeRecord = DB::table($table)->where($parentField, $id)->where("slug", $this->get("slug"))->first();
                $id = ($localeRecord ? $localeRecord->id : null);
            }
        }

        return "unique:{$table},{$field},{$id},id";
    }

    protected function addSeoRules(array $rules): array
    {
        $seoRules = [
            'meta_title' => "nullable|string|max:100",
            'meta_keywords' => "nullable|string|max:500",
            'meta_description' => "nullable|string|max:500",
        ];

        return array_merge($rules, $seoRules);
    }

    protected function addActiveFlgRules(array $rules): array
    {
        return array_merge($rules, [
            'active_flg' => "boolean",
        ]);
    }
}
