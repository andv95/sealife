<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZTeam
 * @package App\Models
 */
class ZTeam extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'branch'];

    public $translatedAttributes = [
        'name', 'position', 'image', 'content'
    ];

    const BRANCH_HALONG = 1;
    const BRANCH_HANOI = 2;
    const BRANCH_HCM = 3;

    const BRANCHES = [
        self::BRANCH_HALONG,
        self::BRANCH_HANOI,
        self::BRANCH_HCM,
    ];

    /**
     * @param $branch
     * @return self|null
     */
    public static function getListByBranch($branch)
    {
        $list = self::getEloquentList()
            ->where('branch', $branch)
            ->latest()
            ->active();

        return $list->get();
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return Helper::getImageCacheUrl("meet-our-team", @$this->image['url']);
    }
}
