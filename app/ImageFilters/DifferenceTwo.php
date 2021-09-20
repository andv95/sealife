<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class DifferenceTwo implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(360, 260);
    }
}
