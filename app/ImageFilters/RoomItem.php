<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class RoomItem implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(330, 225);
    }
}
