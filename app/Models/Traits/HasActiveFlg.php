<?php

namespace App\Models\Traits;

/**
 * Trait HasActiveFlg
 * @package App\Models\Traits
 *
 * @property boolean $active_flg
 */
trait HasActiveFlg
{
    public function scopeActive($query)
    {
        return $query->where("active_flg", true);
    }

    public function isActive(): bool
    {
        return !!$this->active_flg;
    }
}
