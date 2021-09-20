<?php

namespace App\Models\Translations;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingTranslation
 * @package App\Models\Translations
 *
 * @property Setting $setting
 * @property string $locale
 */
class SettingTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['translated_value'];

    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
}
