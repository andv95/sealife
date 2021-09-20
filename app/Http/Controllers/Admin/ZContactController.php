<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Models\ZContact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class ZContactController
 * @package App\Http\Controllers\Admin
 *
 * @property ZContact $model
 */
class ZContactController extends BaseController
{
    private $model;
    private $slug;

    public function __construct()
    {
        $this->model = new ZContact();
        $this->slug = 'z_contacts';
    }

    public function index()
    {
        return view("admin.pages.{$this->slug}.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->addColumn("full_name", function ($data) {
                return $data->getFullName();
            })
            ->addColumn("action_show", function ($data) {
                return view(
                    "admin.actions.button-show",
                    ["url" => route("admin.{$this->slug}.show", $data->getKey())]
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

    public function show($id)
    {
        if (!$data = $this->model::getById($id)) {
            return abort(Helper::HTTP_NOT_FOUND);
        }

        return view(
            "admin.pages.{$this->slug}.show",
            compact("data")
        );
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
