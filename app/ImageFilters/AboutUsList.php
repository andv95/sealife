<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class AboutUsList implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(700, 460);
    }
}
