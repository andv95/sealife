<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\HasLocaleTrait;
use App\Http\Requests\Admin\MenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class MenuItemController
 * @package App\Http\Controllers\Admin
 *
 * @property MenuItem $model
 */
class MenuItemController extends BaseController
{
    use HasLocaleTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new MenuItem();
        $this->slug = 'menu_items';
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->editColumn("menu_id", function ($data) {
                return ($menu = $data->menu) ? $menu->name : "";
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
            ->make(true);
    }

    public function create(Request $request)
    {
        $data = $this->model;
        $menus = Menu::getList();
        $menu = null;

        if ($menuId = $request->get("menu_id")) {
            $menu = $menus->filter(function ($item) use ($menuId) {
                return $item->getKey() == $menuId;
            })->first();

            if (!$menu) {
                return abort(Helper::HTTP_NOT_FOUND);
            }
        }

        $compactParams = array_merge(
            compact("data", "menus", "menu"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function store(MenuItemRequest $request)
    {
        try {
            $this->model::storeUpdateByLocale($request->get("language_key"), $request->all());

            if ($redirectUrl = $request->get("redirect_url")) {
                return redirect($redirectUrl)
                    ->with("successMessages", __("admin_global.message_store_success"));
            }

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

        $menus = Menu::getList();

        $compactParams = array_merge(
            compact("data", "menus"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function update(MenuItemRequest $request, $id)
    {
        try {
            if (!$data = $this->model::getById($id)) {
                return abort(Helper::HTTP_NOT_FOUND);
            }

            $newData = $this->model::storeUpdateByLocale($request->get("language_key"), $request->all(), $data);

            return redirect()
                ->route("admin.menus.drop_drag", (($menu = $newData->menu) ? $menu->getKey() : null))
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
}
