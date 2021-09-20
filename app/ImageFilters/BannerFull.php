<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class BannerFull implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(1600, null, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
