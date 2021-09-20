<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\HasLocaleTrait;
use App\Http\Requests\Admin\ZPackageRequest;
use App\Models\ZCruise;
use App\Models\ZDestination;
use App\Models\ZDuration;
use App\Models\ZOffer;
use App\Models\ZPackage;
use App\Models\ZPost;
use App\Models\ZSpecialOffer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class ZPackageController
 * @package App\Http\Controllers\Admin
 *
 * @property ZPackage $model
 */
class ZPackageController extends BaseController
{
    use HasLocaleTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new ZPackage();
        $this->slug = "z_packages";
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all(), ["zCruise", "zDuration"]))
            ->escapeColumns([])
            ->editColumn("z_cruise_id", function ($data) {
                return ($zCruise = $data->zCruise) ? $zCruise->global_name : "";
            })
            ->editColumn("z_duration_id", function ($data) {
                return ($zDuration = $data->zDuration) ? $zDuration->global_name : "";
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
        $zCruises = ZCruise::getList();
        $zDurations = ZDuration::getList();
        $zOffers = ZOffer::getList();
        $zSpecialOffers = ZSpecialOffer::getList();
        $zDestinations = ZDestination::getList();
        $zPosts = ZPost::getListByType(ZPost::TYPE_ACTIVITY);
        $apiIds = $this->model::getApiIds();

        $compactParams = array_merge(
            compact("data", "zCruises", "zDurations", "zOffers", "zDestinations", "zPosts", "zSpecialOffers", "apiIds"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function store(ZPackageRequest $request)
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
        if (!$data = $this->model::getById($id, ["zDestinations", "zOffers"])) {
            return abort(Helper::HTTP_NOT_FOUND);
        }

        $zCruises = ZCruise::getList();
        $zDurations = ZDuration::getList();
        $zOffers = ZOffer::getList();
        $zDestinations = ZDestination::getList();
        $zPosts = ZPost::getListByType(ZPost::TYPE_ACTIVITY);
        $zSpecialOffers = ZSpecialOffer::getList();
        $apiIds = $this->model::getApiIds();

        $compactParams = array_merge(
            compact("data", "zCruises", "zDurations", "zOffers", "zDestinations", "zPosts", "zSpecialOffers", "apiIds"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function update(ZPackageRequest $request, $id)
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

    public function getItineraryView(Request $request)
    {
        try {
            $data['key'] = (int)$request->get("key");

            return $this->ajaxSuccessResponse(
                view("admin.pages.{$this->slug}.sub.itinerary-item", $data)->render()
            );
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(
                Helper::HTTP_SERVER_ERROR,
                __("admin_global.message_http_500", ["error" => $exception->getMessage()])
            );
        }
    }
}
