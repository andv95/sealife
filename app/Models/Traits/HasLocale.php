<?php

namespace App\Models\Traits;

use Astrotomic\Translatable\Translatable;
use Exception;

/**
 * Trait HasLocale
 * @package App\Models\Traits
 *
 * @property string $language_key
 * @property int $root_id
 */
trait HasLocale
{
    use Translatable;

    /**
     * @param string $locale
     * @param array $data
     * @param null $recordOrId
     * @return self
     * @throws Exception
     */
    public static function storeUpdateByLocale(string $locale, array $data = [], $recordOrId = null)
    {
        if (!in_array(ModelBasically::class, class_uses(self::class))) {
            throw new Exception("This model don't use ModelBasically trait");
        }

        foreach ((new self())->translatedAttributes as $translatedAttribute) {
            $data[$locale][$translatedAttribute] = @$data[$translatedAttribute];
            unset($data[$translatedAttribute]);
        }

        return self::storeUpdate($data, $recordOrId);
    }
}
