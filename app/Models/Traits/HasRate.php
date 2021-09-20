<?php

namespace App\Models\Traits;


use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRate
{
    public $rate_type = 'blog';

    function rates(): HasMany
    {
        return $this->hasMany(Rating::class, 'item_id', 'id')
            ->where('item_type', '=', $this->rate_type);
    }

    function rate_avg()
    {
        $rates = $this->rates->where('locale', '=', curLocale());
        return [
            'count' => $rates->count() ?: 0,
            'avg' => $rates->avg('rate_value'),
        ];
    }
}
