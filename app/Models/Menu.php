<?php

namespace App\Models;

use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class Menu
 * @package App\Models
 *
 * @property MenuItem $rootMenuItems
 * @property string $name
 */
class Menu extends Model
{
    use ModelBasically, HasActiveFlg;

    public $timestamps = false;

    protected $fillable = ['name', 'active_flg'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, "menu_id");
    }

    public function rootMenuItems()
    {
        return $this->menuItems()
            ->rootItems()
            ->orderBy("order", "asc");
    }

    public static function getMenuCacheKey(string $name, string $languageKey): string
    {
        return "menus.{$name}.{$languageKey}";
    }

    public static function getMenuByName(string $name)
    {
        $cacheKey = self::getMenuCacheKey($name, curLocale());

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $menu = self::getEloquentList([], ["rootMenuItems"])
            ->where("name", $name)
            ->first();

        Cache::forever($cacheKey, $menu);

        return $menu;
    }

    public static function getMenuLayout($nameOrMenu, array $params = [], $view = null)
    {
        if (!$nameOrMenu instanceof self) {
            $nameOrMenu = self::getMenuByName($nameOrMenu);
        }

        if (!$nameOrMenu || !$nameOrMenu->isActive()) {
            return null;
        }

        $rootMenuItems = $nameOrMenu->rootMenuItems;

        if (!$view) {
            return self::getRecursiveMenuItemsLayout($rootMenuItems, $nameOrMenu, $params);
        }

        return view($view, ["menus" => $nameOrMenu, "menuItems" => $rootMenuItems]);
    }

    private static function getRecursiveMenuItemsLayout($menuItems, Menu $menu, array $params = [])
    {
        /**@var Collection|MenuItem[] $menuItems */
        if (!$menuItems->count()) {
            return "";
        }

        $html = (@$params['start_tag'] ?? '<ul>');
        $view = (@$params['item_view'] ?? 'menus.default');

        foreach ($menuItems as $menuItem) {
            $childrenLayout = "";
            $hasSubMenu = false;

            if ($menuItem->menuItems->count()) {
                $childrenLayout .= self::getRecursiveMenuItemsLayout($menuItem->menuItems, $menu, $params);
                $hasSubMenu = true;
            }

            $html .= view(
                $view,
                compact('childrenLayout', 'menuItem', 'menu', "hasSubMenu")
            )->render();
        }

        $html .= (@$params['end_tag'] ?? '</ul>');

        return $html;
    }

    public static function reOrderMenuItems(array $serializeMenuItems, int $parentId = null)
    {
        $order = 0;

        foreach ($serializeMenuItems as $data) {
            if ($menuItem = MenuItem::getById($data['id'])) {
                $params['order'] = $order;
                $params['parent_id'] = $parentId;

                if (!MenuItem::storeUpdate($params, $menuItem)) {
                    return false;
                }

                if (is_array(@$data['children'])) {
                    self::reOrderMenuItems($data['children'], $menuItem->getKey());
                }

                $order++;
            }
        }

        return true;
    }
}
