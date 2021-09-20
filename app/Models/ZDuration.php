<?php

namespace App\Models;

use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZDuration
 * @package App\Models
 *
 * @property int $point
 */
class ZDuration extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale;

    protected $fillable = ['active_flg', 'global_name', "point"];

    public $translatedAttributes = ['name', 'short_name'];

    public function getPointNight()
    {
        return (int)$this->point;
    }
}
