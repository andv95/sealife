<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\HasLocaleTrait;
use App\Http\Requests\Admin\ZCruiseRequest;
use App\Models\ZCruise;
use App\Models\ZPost;
use App\Models\ZProperty;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class ZCruiseController
 * @package App\Http\Controllers\Admin
 *
 * @property ZCruise $model
 */
class ZCruiseController extends BaseController
{
    use HasLocaleTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new ZCruise();
        $this->slug = 'z_cruises';
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all(), ['zProperty']))
            ->escapeColumns([])
            ->editColumn("z_property_id", function ($data) {
                return ($zProperty = $data->zProperty) ? $zProperty->global_name : "";
            })
            ->editColumn("home_flg", function ($data) {
                return $data->home_flg ? __("admin_global.option_yes") : "";
            })
            ->editColumn("active_flg", function ($data) {
                return view(
                    "admin.actions.button-toggle-active-flg",
                    compact("data")
                )->render();
            })
            ->addColumn("action_edit", function ($data) {
                return view(
                    "admin.actions.button-edit",
                    ["url" => route("admin.{$this->slug}.edit", $data->getKey())]
                )->render();
            })
            ->addColumn("action_delete", function ($data) {
                return view(
                    "admin.actions.button-delete",
                    ["url" => route("admin.{$this->slug}.destroy", ["ids" => $data->getKey()])]
                )->render();
            })
            ->addColumn("action_clone", function ($data) {
                return view(
                    "admin.actions.button-clone",
                    ["url" => $data->getCloneUrl()]
                )->render();
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        $data = $this->model;
        $zProperties = ZProperty::getList();
        $zPosts = ZPost::getListByType(ZPost::TYPE_EXPERIENCE);

        $compactParams = array_merge(
            compact("data", "zProperties", "zPosts"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function store(ZCruiseRequest $request)
    {
        try {
            $this->model::storeUpdateWithRelations($request->get("language_key"), $request->all());

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

        $zProperties = ZProperty::getList();
        $zPosts = ZPost::getListByType(ZPost::TYPE_EXPERIENCE);

        $compactParams = array_merge(
            compact("data", "zProperties", "zPosts"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function update(ZCruiseRequest $request, $id)
    {
        try {
            if (!$data = $this->model::getById($id)) {
                return abort(Helper::HTTP_NOT_FOUND);
            }

            $this->model::storeUpdateWithRelations($request->get("language_key"), $request->all(), $data);

            return back()
                ->with("successMessages", __("admin_global.message_update_success"))
                ->withInput();
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
}
