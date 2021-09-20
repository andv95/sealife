<?php

namespace App\Exceptions;

use App\Helpers\Helper;
use Exception;

class NotFoundRecord extends Exception
{
    public function report()
    {
        //
    }

    public function render($request)
    {
        return abort(Helper::HTTP_NOT_FOUND);
    }
}
