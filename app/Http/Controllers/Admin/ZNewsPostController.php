<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\HasLocaleTrait;
use App\Http\Requests\Admin\ZNewsPostRequest;
use App\Models\ZNewsPost;
use App\Models\ZNewsType;
use App\Models\ZPackage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class ZNewsPostController
 * @package App\Http\Controllers\Admin
 *
 * @property ZNewsPost $model
 */
class ZNewsPostController extends BaseController
{
    use HasLocaleTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new ZNewsPost();
        $this->slug = 'z_news_posts';
    }

    public function index()
    {
        $categories = ZNewsType::getShowList();

        return view("admin.pages.{$this->slug}.index", compact("categories"));
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->editColumn("featured1_flg", function ($data) {
                return $data->isFeatured1() ? "x" : "";
            })
            ->editColumn("featured2_flg", function ($data) {
                return $data->isFeatured2() ? "x" : "";
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
        $zNewsTypes = ZNewsType::getList();
        $zPackages = ZPackage::getList();

        $compactParams = array_merge(
            compact("data", "zNewsTypes", "zPackages"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function store(ZNewsPostRequest $request)
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

        $zNewsTypes = ZNewsType::getList();
        $zPackages = ZPackage::getList();

        $compactParams = array_merge(
            compact("data", "zNewsTypes", "zPackages"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function update(ZNewsPostRequest $request, $id)
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
