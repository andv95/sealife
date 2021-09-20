<?php

namespace App\Models;

use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

class ZSpecialOffer extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasClone;

    protected $fillable = ['active_flg', 'global_name', 'order_no'];

    public $translatedAttributes = ['name', 'short_desc', 'invalid_desc'];
}
