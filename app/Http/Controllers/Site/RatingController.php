<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Exception;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    function ajax(Request $request)
    {
        $output = [
            'isSuccess' => true,
            'message' => '',
        ];
        try {
            $attributes = [
                'item_id' => (int)$request->get('id'),
                'item_type' => $request->get('type', 'blog'),
                'locale' => $request->get('locale', 'vi'),
                'rate_value' => $request->get('value', 0),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer' => $request->header('referer'),
            ];
            $rating = new Rating();
            $rating->fill($attributes);
            $rating->save();
            $output['message'] = __('site_global.rate.cam_on');
        } catch (Exception $exception) {
            $output['isSuccess'] = false;
        }

        return response()->json($output);
    }
}
