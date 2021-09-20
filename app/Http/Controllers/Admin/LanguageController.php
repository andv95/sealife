<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class LanguageController
 * @package App\Http\Controllers\Admin
 *
 * @property Language $model
 */
class LanguageController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new Language();
    }

    public function index()
    {
        return view("admin.pages.languages.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->addColumn("action_edit", function ($item) {
                return view(
                    "admin.actions.button-edit",
                    ["url" => route("admin.languages.edit", $item->getKey())]
                )->render();
            })
            ->addColumn("action_delete", function ($item) {
                if ($item->isDefaultLanguageKey()) {
                    return "";
                }

                return view(
                    "admin.actions.button-delete",
                    ["url" => route("admin.languages.destroy", ["ids" => $item->getKey()])]
                )->render();
            })
            ->make(true);
    }

    public function create()
    {
        return view(
            "admin.pages.languages.edit-add",
            [
                "data" => $this->model,
                "supportedLanguages" => Language::getPackageLocales()
            ]
        );
    }

    public function store(LanguageRequest $request)
    {
        try {
            $this->model::storeUpdate($request->all());

            return redirect()
                ->route("admin.languages.index")
                ->with("successMessages", __("admin_global.message_store_success"));
        } catch (Throwable $exception) {
            return back()
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]))
                ->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        if (!$data = $this->model::getById($id)) {
            return abort(Helper::HTTP_NOT_FOUND);
        }

        return view(
            "admin.pages.languages.edit-add",
            [
                "data" => $data,
                "supportedLanguages" => Language::getPackageLocales()
            ]
        );
    }

    public function update(LanguageRequest $request, $id)
    {
        try {
            if (!$data = $this->model::getById($id)) {
                return abort(Helper::HTTP_NOT_FOUND);
            }

            if ($data->isDefaultLanguageKey() && empty($request->get("active_flg"))) {
                return back()
                    ->with("errorMessages", __("admin_global.message_cant_destroy_default_language"))
                    ->withInput();
            }

            $this->model::storeUpdate($request->all(), $id);

            return back()
                ->with("successMessages", __("admin_global.message_update_success"));
        } catch (Throwable $exception) {
            if ($exception instanceof NotFoundRecord) {
                return back()
                    ->with("errorMessages", __("admin_global.message_http_404", ["id" => $id]))
                    ->withInput();
            }

            return back()
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]))
                ->withInput();
        }
    }

    public function destroy(Request $request)
    {
        try {
            $ids = explode(",", $request->get("ids"));
            $ids = array_filter($ids);

            if (!$data = $this->model::getById(@$ids[0])) {
                return back()
                    ->with("errorMessages", __("admin_global.message_http_404", ["id" => ""]));
            }

            if ($data->isDefaultLanguageKey()) {
                return back()
                    ->with("errorMessages", __("admin_global.message_cant_destroy_default_language"));
            }

            $this->model::destroyByIds($ids);

            return back()
                ->with("successMessages", __("admin_global.message_destroy_success", ["count" => count($ids)]));
        } catch (Throwable $exception) {
            return back()
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]));
        }
    }
}
