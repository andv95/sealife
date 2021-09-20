<?php

namespace App\Models\Traits;

/**
 * Trait HasSeo
 * @package App\Models\Traits
 *
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
trait HasSeo
{
    public function getSeoTitle()
    {
        return $this->meta_title;
    }

    public function getSeoKeywords()
    {
        return $this->meta_keywords;
    }

    public function getSeoDesc()
    {
        return $this->meta_description;
    }
}
