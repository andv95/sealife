<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\HasLocaleTrait;
use App\Models\ZPackage;
use Illuminate\Http\Request;


class ZPackageController extends BaseController
{
    use HasLocaleTrait;

    public function __construct()
    {
        //$this->model = new ZPackage();
        //$this->slug = "z_packages";
    }

    public function ajax_package_price_min(Request $request, $package_id)
    {
        //dd($request->headers->get('referer'));
        $package = ZPackage::query()->without('zDuration')->find($package_id);
        if (!$package) {
            return __("site_global.label_price_contact_us");
        }
        return $package->getMinPriceText();
    }
}
