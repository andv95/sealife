<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\ZInsPhotoRequest;
use App\Models\ZInsPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class ZInsPhotoController
 * @package App\Http\Controllers\Admin
 *
 * @property ZInsPhoto $model
 */
class ZInsPhotoController extends BaseController
{
    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new ZInsPhoto();
        $this->slug = 'z_ins_photos';
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->editColumn("url", function ($item) {
                return view(
                    "admin.includes.image-datatable",
                    ["url" => $item->url]
                )->render();
            })
            ->editColumn("active_flg", function ($data) {
                return view(
                    "admin.actions.button-toggle-active-flg",
                    compact("data")
                )->render();
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

    public function store(ZInsPhotoRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->model::storeFromInstagramByTag($request->get("tag"));
            DB::commit();

            return back()
                ->with("successMessages", __("admin_global.message_store_success"))
                ->withInput();
        } catch (Throwable $exception) {
            DB::rollBack();

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
            ['data' => $data, 'positions' => $this->model::NO_POSITIONS]
        );
    }

    public function update(ZInsPhotoRequest $request, $id)
    {
        try {
            if (!$data = $this->model::getById($id)) {
                return abort(Helper::HTTP_NOT_FOUND);
            }

            $this->model::storeUpdate($request->only("position_no", 'active_flg'), $id);

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

            if (!$data = $this->model::getById($ids[0])) {
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
