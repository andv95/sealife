<?php

namespace App\Observers;

use App\Models\Menu;
use App\Models\MenuItem;

class MenuItemObserver
{
    public function saved(MenuItem $menuItem)
    {
        if ($menuItem->isDirty("menu_id")) {
            $menu = Menu::getById($menuItem->getOriginal("menu_id"));

            if ($menu) {
                (new MenuObserver())->forgetSetting($menu->name);
            }
        }

        if ($menu = $menuItem->menu) {
            (new MenuObserver())->forgetSetting($menu->name);
        }
    }

    public function deleting(MenuItem $menuItem)
    {
        if ($menu = $menuItem->menu) {
            (new MenuObserver())->forgetSetting($menu->name);
        }
    }
}
