<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\JsonResponseTrait;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class MenuController
 * @package App\Http\Controllers\Admin
 *
 * @property Menu $model
 */
class MenuController extends BaseController
{
    use JsonResponseTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new Menu();
        $this->slug = 'menus';
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->editColumn("active_flg", function ($data) {
                return view(
                    "admin.actions.button-toggle-active-flg",
                    compact("data")
                )->render();
            })
            ->addColumn("action_menu_build", function ($item) {
                $text = __("admin_table.menus.label_drop_drag");
                $url = route("admin.{$this->slug}.drop_drag", $item->getKey());

                return "<a href='{$url}' target='_blank' title='{$text}'>{$text}</a>";
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
            ["data" => $this->model]
        );
    }

    public function store(MenuRequest $request)
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
            compact("data")
        );
    }

    public function update(MenuRequest $request, $id)
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

    public function dropDrag($id)
    {
        if (!$menu = $this->model::getById($id)) {
            return abort(Helper::HTTP_NOT_FOUND);
        }

        return view(
            "admin.pages.{$this->slug}.drop-drag",
            compact("menu")
        );
    }

    public function sortAfterDropDrag(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            if (!$this->model::getById($id)) {
                return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND, __("admin_global.message_http_404"));
            }

            $serializeMenuItems = @Helper::jsonDecode($request->get("serialize_data"), true);
            $serializeMenuItems = (is_array($serializeMenuItems) ? $serializeMenuItems : []);

            if (!$this->model::reOrderMenuItems($serializeMenuItems)) {
                return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND, __("admin_global.message_http_404"));
            }

            DB::commit();

            return $this->ajaxSuccessResponse([], __("admin_table.menus.message_re_order_menu_item_success"));
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }
}
