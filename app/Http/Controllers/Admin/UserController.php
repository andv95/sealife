<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 *
 * @property User $model
 */
class UserController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        return view("admin.pages.users.index");
    }

    public function getTableData(Request $request)
    {
        return DataTables::of($this->model::getEloquentList($request->all()))
            ->escapeColumns([])
            ->addColumn("action_edit", function ($item) {
                if (currentUser()->canEditOrDestroyOtherUser($item->getKey())) {
                    return view(
                        "admin.actions.button-edit",
                        ["url" => route("admin.users.edit", $item->getKey())]
                    )->render();
                }

                return "";
            })
            ->addColumn("action_delete", function ($item) {
                if (currentUser()->canEditOrDestroyOtherUser($item->getKey())) {
                    return view(
                        "admin.actions.button-delete",
                        ["url" => route("admin.users.destroy", ["ids" => $item->getKey()])]
                    )->render();
                }

                return "";
            })
            ->make(true);
    }

    public function create()
    {
        return view(
            "admin.pages.users.edit-add",
            ["data" => $this->model]
        );
    }

    public function store(UserRequest $request)
    {
        try {
            $params = $request->only("name", "email", "password");

            $this->model::storeUpdate($params);

            return redirect()
                ->route("admin.users.index")
                ->with("successMessages", __("admin_global.message_store_success"));
        } catch (Throwable $exception) {
            return back()
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]))
                ->withInput();;
        }
    }

    public function edit(Request $request, $id)
    {
        if (!currentUser()->canEditOrDestroyOtherUser((int)$id)) {
            return abort(Helper::HTTP_FORBIDDEN);
        }

        if (!$data = $this->model::getById($id)) {
            return abort(Helper::HTTP_NOT_FOUND);
        }

        return view(
            "admin.pages.users.edit-add",
            compact('data')
        );
    }

    public function update(UserRequest $request, $id)
    {
        try {
            if (!currentUser()->canEditOrDestroyOtherUser((int)$id)) {
                return abort(Helper::HTTP_FORBIDDEN);
            }

            $params = $request->only("name", "email");

            if ($password = $request->get("password")) {
                $params['password'] = $password;
            }

            $this->model::storeUpdate($params, $id);

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

            if (!currentUser()->canEditOrDestroyOtherUser($ids)) {
                return abort(Helper::HTTP_FORBIDDEN);
            }

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
