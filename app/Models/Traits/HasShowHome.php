<?php

namespace App\Models\Traits;

/**
 * Trait HasShowHome
 * @package App\Models\Traits
 */
trait HasShowHome
{
    public function scopeShowAtHome($query)
    {
        return $query->where("home_flg", true);
    }
}
