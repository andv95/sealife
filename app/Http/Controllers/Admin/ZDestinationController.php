<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\HasLocaleTrait;
use App\Http\Requests\Admin\ZDestinationRequest;
use App\Models\ZDestination;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ZDestinationController
 * @package App\Http\Controllers\Admin
 *
 * @property ZDestination $model
 */
class ZDestinationController extends BaseController
{
    use HasLocaleTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new ZDestination();
        $this->slug = 'z_destinations';
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all(), ["zDestination"]))
            ->escapeColumns([])
            ->editColumn("z_destination_id", function ($data) {
                return ($zDestination = $data->zDestination) ? $zDestination->global_name : "";
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
        $zDestinations = ZDestination::getEloquentList()->active()->get();

        $compactParams = array_merge(
            compact("data", "zDestinations"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function store(ZDestinationRequest $request)
    {
        try {
            $this->model::storeUpdateByLocale($request->get("language_key"), $request->all());

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

        $zDestinations = ZDestination::getEloquentList()->active()->get();

        $compactParams = array_merge(
            compact("data", "zDestinations"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function update(ZDestinationRequest $request, $id)
    {
        try {
            if (!$data = $this->model::getById($id)) {
                return abort(Helper::HTTP_NOT_FOUND);
            }

            $this->model::storeUpdateByLocale($request->get("language_key"), $request->all(), $data);

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
