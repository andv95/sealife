<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class AdminHelper
{
    public static function getHtmlAdminMenus()
    {
        $menus = config("admin_menu");
        $currentUrl = request()->fullUrl();

        foreach ($menus as $key => $menu) {
            if (@$menu['routes']['name'] && Str::startsWith($currentUrl, route(@$menu['routes']['name']))) {
                $menus[$key]['isActive'] = true;
            }

            if (isset($menu['children'])) {
                foreach ($menu['children'] as $key2 => $childMenu) {
                    if (@$childMenu['routes']['name'] && Str::startsWith($currentUrl, route(@$childMenu['routes']['name']))) {
                        $menus[$key]['children'][$key2]['isActive'] = true;
                        $menus[$key]['isActive'] = true;
                    }
                }
            }
        }

        return view("admin.menus.sidebar-menus", compact("menus"))->render();
    }
}
