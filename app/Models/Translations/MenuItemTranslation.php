<?php

namespace App\Models\Translations;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuItemTranslation
 * @package App\Models\Translations
 *
 * @property MenuItem $menuItem
 * @property string $locale
 */
class MenuItemTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'url', 'open_target'
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
