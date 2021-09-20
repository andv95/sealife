<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Jobs\StoreIgMediaData;
use App\Services\IgService;
use Illuminate\Http\Request;
use Throwable;

class IgOAuthController extends BaseController
{

    public function auth(Request $request)
    {
        try {
            if ($code = $request->get("code")) {
                $igService = new IgService();
                $igService->setAccessTokenByCode($code);

                return redirect()
                    ->route("admin.z_ins_photos.index")
                    ->with("successMessages", 'Token: ' . $igService->getAccessToken());
            }

            if ($errorMessage = $request->get("error_description")) {
                return redirect()
                    ->route("admin.z_ins_photos.index")
                    ->with("errorMessages", $errorMessage);
            }

            return redirect(IgService::getLoginUrl());
        } catch (Throwable $exception) {
            return redirect()
                ->route("admin.z_ins_photos.index")
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]));
        }
    }

    public function getUserMedia(Request $request)
    {
        try {
            $igService = new IgService();
            if ($igService->getAccessToken()) {
                $data = $igService->getUserMedia();
                if (array_key_exists("data", $data)) {
                    $this->dispatch(new StoreIgMediaData($data));

                    return redirect()
                        ->route("admin.z_ins_photos.index")
                        ->with("successMessages", __("admin_global.message_store_success"));
                }

                return redirect()
                    ->route("admin.z_ins_photos.index")
                    ->with("errorMessages", __("admin_global.message_http_404"));
            } else {
                return redirect()
                    ->route("admin.z_ins_photos.index")
                    ->with("errorMessages", 'Instagram token not found');
            }
        } catch (Throwable $exception) {
            return redirect()
                ->route("admin.z_ins_photos.index")
                ->with("errorMessages", __("admin_global.message_http_500", ["error" => $exception->getMessage()]));
        }
    }

    function truncate()
    {
        \Illuminate\Support\Facades\DB::table("z_ins_photos")->truncate();
        return "Hello world!";
    }
}
