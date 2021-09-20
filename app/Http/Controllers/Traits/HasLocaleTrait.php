<?php

namespace App\Http\Controllers\Traits;

use App\Helpers\Helper;
use App\Models\Language;
use Illuminate\Http\Request;
use Throwable;
use Exception;

trait HasLocaleTrait
{
    use JsonResponseTrait;

    public function getDataLanguage(Request $request)
    {
        try {
            if (!property_exists($this, "slug")) {
                throw new Exception("No slug for this controller");
            }

            if (!$locale = $request->get("language_key")) {
                return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND, __("admin_global.message_no_language_selected"));
            }

            if (!is_null($request->get("id"))) {
                $dataRoot = $this->model::getById($request->get("id"));
            } else {
                $dataRoot = $this->model;
            }

            if (!$dataRoot instanceof $this->model) {
                return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND, __("admin_global.message_http_404"));
            }

            $data = $dataRoot->translateOrNew($locale);

            return $this->ajaxSuccessResponse(
                view("admin.pages.{$this->slug}.edit-add-locale", compact("data", "dataRoot"))->render()
            );
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(
                Helper::HTTP_SERVER_ERROR,
                __("admin_global.message_http_500", ["error" => $exception->getMessage()])
            );
        }
    }

    private function getLanguagesAndDataTranslationArray($data): array
    {
        $languages = Language::getLanguages();
        $locale = (($firstLang = $languages->first()) ? $firstLang->getLanguageKey() : null);
        $dataTranslation = $data->translateOrNew($locale);

        return compact("languages", "dataTranslation");
    }
}
