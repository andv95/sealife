<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\HasLocaleTrait;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 *
 * @property Page $model
 */
class PageController extends BaseController
{
    use HasLocaleTrait;

    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new Page();
        $this->slug = 'pages';
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
            ->addColumn("action_edit", function ($data) {
                return view(
                    "admin.actions.button-edit",
                    ["url" => route("admin.{$this->slug}.edit", $data->getKey())]
                )->render();
            })
            ->addColumn("action_delete", function ($data) {
                if ($data->isFixedPage()) {
                    return "";
                }

                return view(
                    "admin.actions.button-delete",
                    ["url" => route("admin.{$this->slug}.destroy", ["ids" => $data->getKey()])]
                )->render();
            })
            ->addColumn("action_clone", function ($data) {
                if ($data->isFixedPage()) {
                    return "";
                }
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
        $viewNames = $this->model::VIEW_NAMES;

        $compactParams = array_merge(
            compact("data", "viewNames"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function store(PageRequest $request)
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

        $viewNames = $this->model::VIEW_NAMES;

        $compactParams = array_merge(
            compact("data", "viewNames"),
            $this->getLanguagesAndDataTranslationArray($data)
        );

        return view(
            "admin.pages.{$this->slug}.edit-add",
            $compactParams
        );
    }

    public function update(PageRequest $request, $id)
    {
        try {
            if (!$data = $this->model::getById($id)) {
                return abort(Helper::HTTP_NOT_FOUND);
            }

            if ($data->isFixedPage()) {
                $params = $request->only('meta_title', 'meta_keywords', 'meta_description', "global_name");
            } else {
                $params = $request->all();
            }

            $this->model::storeUpdateByLocale($request->get("language_key"), $params, $data);

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

            if (!$data = $this->model::getById(@$ids[0])) {
                return back()
                    ->with("errorMessages", __("admin_global.message_http_404", ["id" => ""]));
            }

            if ($data->isFixedPage()) {
                return back()
                    ->with("errorMessages", "Don't try to destroy my fixed page! :))");
            }

            $this->model::destroyByIds($ids);

            return back()
                ->with("successMessages", __("admin_global.message_destroy_success", ["count" => count($ids)]));
        } catch (Throwable $exception) {
            return back()
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]));
        }
    }

    public function getSubView(Request $request)
    {
        try {
            $data['key'] = (int)$request->get("key");
            $view = $request->get("view");

            return $this->ajaxSuccessResponse(
                view("admin.pages.{$this->slug}.sub.{$view}", $data)->render()
            );
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(
                Helper::HTTP_SERVER_ERROR,
                __("admin_global.message_http_500", ["error" => $exception->getMessage()])
            );
        }
    }
}
