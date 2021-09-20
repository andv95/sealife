<?php

namespace App\Models;

use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

class ZNewsletter extends Model
{
    use ModelBasically;

    protected $fillable = [
        'mail_address'
    ];
}
