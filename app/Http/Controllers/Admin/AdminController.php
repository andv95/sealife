<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Throwable;

class AdminController extends BaseController
{
    use JsonResponseTrait;

    public function home()
    {
        return view("admin.pages.dashboard");
    }

    public function getEditAddImageField(Request $request)
    {
        try {
            $data['key'] = (int)$request->get("key");
            $data['multiple'] = true;
            $data['field'] = $request->get("field");
            $data['id'] = $request->get("id");
            $data['params'] = $request->get("params", []);

            return $this->ajaxSuccessResponse(
                view("admin.includes.image-edit-add-field", $data)->render()
            );
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(
                Helper::HTTP_SERVER_ERROR,
                __("admin_global.message_http_500", ["error" => $exception->getMessage()])
            );
        }
    }
}
