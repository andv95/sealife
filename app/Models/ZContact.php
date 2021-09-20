<?php

namespace App\Models;

use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZContact
 * @package App\Models
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 */
class ZContact extends Model
{
    use ModelBasically;

    protected $fillable = [
        "first_name", "last_name",
        "email", "phone",
        "looking_for", "interested_in",
        "something_else"
    ];

    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getContactInformation()
    {
        return $this->email . " - " . $this->phone;
    }
}
