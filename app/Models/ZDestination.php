<?php

namespace App\Models;

use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Model;

class ZDestination extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasClone;

    protected $fillable = ['z_destination_id', 'active_flg', 'global_name'];

    public $translatedAttributes = [
        'name', 'slug', 'image', 'images', 'description', 'summary',
        'meta_title', 'meta_keywords', 'meta_description'
    ];

    public function zDestination()
    {
        return $this->belongsTo(self::class);
    }

    public static function getListToSearch()
    {
        return self::getEloquentList()
            ->withTranslation()
            ->active()
            ->whereNull("z_destination_id")
            ->get();
    }
}
