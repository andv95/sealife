<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'item_id', 'item_type', 'locale', 'rate_value', 'ip', 'user_agent', 'referer'
    ];
}
