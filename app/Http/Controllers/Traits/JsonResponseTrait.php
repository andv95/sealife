<?php

namespace App\Http\Controllers\Traits;

use App\Helpers\Helper;
use Carbon\Carbon;

trait JsonResponseTrait
{
    public function ajaxSuccessResponse($data = [], $successMessages = [])
    {
        return $this->jsonResponse($data, $successMessages, null, false);
    }

    public function ajaxErrorResponse($statusCode, $errorMessages = [])
    {
        return $this->jsonResponse([], $errorMessages, $statusCode, false);
    }

    public function apiSuccessResponse($data = [], $successMessages = [])
    {
        return $this->jsonResponse($data, $successMessages);
    }

    public function apiErrorResponse($statusCode, $errorMessages = [])
    {
        return $this->jsonResponse([], $errorMessages, $statusCode);
    }

    public function jsonResponse($data = [], $messages = [], $statusCode = null, $isApi = true)
    {
        $statusCode = ($statusCode ?: Helper::HTTP_OK);

        $response = [
            'data' => $data,
            'messages' => (is_array($messages) ? $messages : [$messages]),
            'statusCode' => $statusCode,
            'isSuccess' => ($statusCode === Helper::HTTP_OK),
            'currentTime' => Carbon::now()->timestamp
        ];

        if (!$isApi) {
            $response["messagesHtml"] = view(
                "admin.includes.messages-area",
                [
                    "type" => ($statusCode === Helper::HTTP_OK ? "success" : "danger"),
                    "messages" => $messages
                ]
            )->render();
        }

        return response()->json($response);
    }
}
