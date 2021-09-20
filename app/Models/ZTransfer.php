<?php

namespace App\Models;

use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

class ZTransfer extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasClone;

    protected $fillable = ['active_flg', 'global_name', "order_no"];

    public $translatedAttributes = ['name'];

    public function zPackages()
    {
        return $this->belongsToMany(ZPackage::class, "z_package_transfers");
    }

    public static function storeUpdateWithRelations(string $locale, array $params, $recordOrId = null)
    {
        $data = self::storeUpdateByLocale($locale, $params, $recordOrId);

        if (array_key_exists("z_package_ids", $params)) {
            $data->zPackages()->sync($params["z_package_ids"]);
        }

        return $data;
    }
}
