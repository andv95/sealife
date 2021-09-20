<?php

namespace App\Models;

use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class MenuItem
 * @package App\Models
 *
 * @property Menu $menu
 * @property MenuItem[]|Collection $menuItems
 * @property string $name
 * @property string $url
 * @property string $open_target
 */
class MenuItem extends Model
{
    use ModelBasically, HasLocale, HasActiveFlg;

    public $timestamps = false;

    protected $fillable = ['global_name', 'menu_id', 'parent_id', 'order', "active_flg"];

    protected $with = ["menuItems", "translations"];

    public $translatedAttributes = [
        'name', 'url', 'open_target'
    ];

    const OPEN_TARGET_SELF = '_self';
    const OPEN_TARGET_BLANK = '_blank';

    const OPEN_TARGETS = [
        self::OPEN_TARGET_SELF,
        self::OPEN_TARGET_BLANK
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menuItems()
    {
        return $this->hasMany(self::class, "parent_id")
            ->orderBy("order", "asc");
    }

    public function scopeRootItems($query)
    {
        return $query->whereNull("parent_id");
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        $url = ltrim($this->url, '/');
        if ($url == '#') {
            return $url;
        }
        $curLocale = curLocale();
        $defaultLocale = defaultLocale();
        $prefix_url = substr($url, 0, 3);
        if ($defaultLocale == $curLocale) {
            if ($prefix_url == "{$curLocale}/") {
                $url = substr($url, 3);
            }
        } else {
            if ($prefix_url != "{$curLocale}/") {
                $url = $curLocale . '/' . $url;
            }
        }
        return Str::start($url, '/');
    }

    public function getOpenTarget()
    {
        return $this->open_target;
    }

    public function isCurrentUrl(): bool
    {
        return false;
    }
}
