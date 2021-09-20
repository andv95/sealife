<?php

namespace App\Models;

use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasShowHome;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZReview
 * @package App\Models
 *
 * @property string $review_date
 */
class ZReview extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasShowHome, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'home_flg'];

    public $translatedAttributes = [
        'name', 'author', 'rating', 'image', 'review_date', 'content'
    ];

    public function getDisplayReviewDate()
    {
        return date('F d, Y', strtotime($this->review_date));
    }

    public function zPackages()
    {
        return $this->belongsToMany(ZPackage::class, "z_package_reviews");
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
