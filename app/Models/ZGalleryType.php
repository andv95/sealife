<?php

namespace App\Models;

use App\Models\Traits\HasLocale;
use App\Models\Traits\HasSeo;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZGalleryType
 * @package App\Models
 *
 * @property ZGallery[]|Collection $zGalleriesActive
 */
class ZGalleryType extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasSeo;

    protected $fillable = ['global_name', 'active_flg', 'parent_id', 'order_no'];

    public $translatedAttributes = [
        'name', 'slug', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    public function zGalleryType()
    {
        return $this->belongsTo(self::class, "parent_id");
    }

    public function zGalleryTypes()
    {
        return $this->hasMany(self::class, "parent_id");
    }

    public function zGalleryTypesActive()
    {
        return $this->zGalleryTypes()->latest()->active();
    }

    public function zGalleries()
    {
        return $this->hasMany(ZGallery::class, 'z_gallery_type_id');
    }

    public function zGalleriesActive()
    {
        return $this->zGalleries()
            ->latest()
            ->active();
    }

    public static function getRootList()
    {
        return self::getEloquentList([], ['zGalleryTypesActive', 'zGalleriesActive'])
            ->active()
            ->whereNull('parent_id')
            ->orderBy('order_no', 'asc')
            ->get();
    }
}
