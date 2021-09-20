<?php

namespace App\Models;

use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

class ZEvent extends Model
{
    use ModelBasically;

    protected $fillable = [
        "service", "group_size", "email", "event_detail"
    ];
}
