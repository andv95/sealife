<?php

namespace App\Models;

use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasShowHome;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Model;

class ZProperty extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasShowHome, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'home_flg'];

    public $translatedAttributes = ['name', 'slug', 'excerpt', 'meta_title', 'meta_keywords', 'meta_description'];

    public function zCruises()
    {
        return $this->hasMany(ZCruise::class);
    }

    public function zCruisesActive()
    {
        return $this->zCruises()->active()->withTranslation();
    }

    public function zCruisesActiveAtHome()
    {
        return $this->zCruisesActive()
            ->with(["zPackagesActive"])
            ->showAtHome();
    }
}
