<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class SettingController
 * @package App\Http\Controllers\Admin
 *
 * @property Setting $model
 */
class SettingController extends BaseController
{
    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new Setting();
        $this->slug = 'settings';
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->editColumn("type", function ($item) {
                /**
                 * @var Setting $item
                 */
                return $item->getTypeDisplayName();
            })
            ->editColumn("group", function ($item) {
                /**
                 * @var Setting $item
                 */
                return $item->getGroupDisplayName();
            })
            ->addColumn("action_edit", function ($item) {
                return view(
                    "admin.actions.button-edit",
                    ["url" => route("admin.{$this->slug}.edit", $item->getKey())]
                )->render();
            })
            ->addColumn("action_delete", function ($item) {
                return view(
                    "admin.actions.button-delete",
                    ["url" => route("admin.{$this->slug}.destroy", ["ids" => $item->getKey()])]
                )->render();
            })
            ->make(true);
    }

    public function create()
    {
        return view(
            "admin.pages.{$this->slug}.edit-add",
            [
                "data" => $this->model,
                "settingTypes" => $this->model::ALL_TYPES,
                "settingGroups" => $this->model::ALL_GROUPS
            ]
        );
    }

    public function store(SettingRequest $request)
    {
        try {
            $this->model::storeUpdate($request->all());

            return redirect()
                ->route("admin.{$this->slug}.index")
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
            "admin.pages.{$this->slug}.edit-add",
            [
                "data" => $data,
                "settingTypes" => $this->model::ALL_TYPES,
                "settingGroups" => $this->model::ALL_GROUPS
            ]
        );
    }

    public function update(SettingRequest $request, $id)
    {
        try {
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

            if (!$ids) {
                return back()
                    ->with("errorMessages", __("admin_global.message_http_404", ["id" => ""]));
            }

            $this->model::destroyByIds($ids);

            return back()
                ->with("successMessages", __("admin_global.message_destroy_success", ["count" => count($ids)]));
        } catch (Throwable $exception) {
            return back()
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]));
        }
    }

    public function configs()
    {
        $allSettings = $this->model::getByGroups($this->model::ALL_GROUPS);
        $allSettings = $allSettings->groupBy("group");
        $settings = [];
        $languageSettings = [];

        foreach ($allSettings as $group => $settingItems) {
            foreach ($settingItems as $setting) {
                if ($setting->hasMultipleLanguages()) {
                    $languageSettings[$group][] = $setting;
                    continue;
                }

                $settings[$group][] = $setting;
            }
        }

        return view("admin.pages.{$this->slug}.config", [
            "languageKeys" => Language::getSupportedLanguageKeys(),
            "settings" => $settings,
            "languageSettings" => $languageSettings
        ]);
    }

    public function updateConfigs(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->model::updateConfigs($request->all());
            DB::commit();

            return back()
                ->with("successMessages", __("admin_global.message_update_success"));
        } catch (Throwable $exception) {
            DB::rollBack();

            return back()
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]))
                ->withInput();
        }
    }
}
