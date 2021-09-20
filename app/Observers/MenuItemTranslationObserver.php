<?php

namespace App\Observers;

use App\Models\Translations\MenuItemTranslation;

class MenuItemTranslationObserver
{
    public function saved(MenuItemTranslation $menuItemTranslation)
    {
        $menuItem = $menuItemTranslation->menuItem;

        if ($menuItem && ($menu = $menuItem->menu)) {
            (new MenuObserver())->forgetSettingByLocale($menuItemTranslation->locale, $menu->name);
        }
    }

    public function deleting(MenuItemTranslation $menuItemTranslation)
    {
        $menuItem = $menuItemTranslation->menuItem;

        if ($menuItem && ($menu = $menuItem->menu)) {
            (new MenuObserver())->forgetSettingByLocale($menuItemTranslation->locale, $menu->name);
        }
    }
}
