<?php

namespace App\Models;

use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasShowHome;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZDistributor
 * @package App\Models
 *
 */
class ZDistributor extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasShowHome, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'order_no'];

    public $translatedAttributes = [
        'name', 'phone', 'email', 'address'
    ];

    public function getPhone()
    {
        $show = '';
        if (!empty($this->phone)) {
            $phones = explode(",", $this->phone);
            $i = 1;

            foreach ($phones as $phone) {
                $phone = str_replace(' ', '', $phone);
                $show .= "<a href='tel:{$phone}' title='phone'>{$phone}</a>";

                if ($i < count($phones)) {
                    $show .= " - ";
                }

                $i++;
            }
        }
        return $show;
    }
}
