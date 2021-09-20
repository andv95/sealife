<?php

namespace App\Models;

use App\Models\Traits\HasLocale;
use App\Models\Traits\HasShowHome;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZPopularKey
 * @package App\Models
 */
class ZPopularKey extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasShowHome;

    protected $fillable = ['global_name', 'active_flg', "order_no"];

    public $translatedAttributes = [
        'name', 'url'
    ];

    public static function getCustomList()
    {
        return self::getEloquentList()
            ->withTranslation()
            ->active()
            ->orderBy("order_no", 'asc')
            ->latest()
            ->get();
    }
}
