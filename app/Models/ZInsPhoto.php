<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * Class ZInsPhoto
 * @package App\Models
 *
 * @property string $ig_media_id
 * @property string $url
 * @property string $tag
 */
class ZInsPhoto extends Model
{
    use ModelBasically, HasActiveFlg;

    protected $fillable = [
        'url', 'tag', 'alt', 'caption', 'active_flg', 'position_no', 'ig_media_id'
    ];

    const NO_POSITIONS = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    public static function storeFromInstagramByTag(string $tag)
    {
        $insImages = Helper::getImagesInstagramByTag($tag);
        $data      = [];

        foreach ($insImages as $image) {
            $data[] = [
                'url'        => Str::substr($image['display_url'], 0, 500),
                'alt'        => Str::substr($image['alt'], 0, 2000),
                'caption'    => Str::substr($image['caption'], 0, 2000),
                'tag'        => $tag,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        return self::insert($data);
    }

    public static function getArrayActiveAndKeyByPosition(int $take = 10)
    {
        return cache()->rememberForever('aaakbp_' . $take, function () use ($take) {
            return self::getEloquentList()
                ->active()
                ->take($take)
                ->orderBy("position_no", "asc")
                ->latest()
                ->get();
        });

//        return $data;

        /*$photos = [];

        foreach (self::NO_POSITIONS as $no) {
            $dataByNo = $data->filter(function ($item) use ($no) {
                return $item->position_no == $no;
            })->first();

            $photos[(string)$no] = ($dataByNo ?: new self());
        }

        return $photos;*/
    }

    public static function storeFromIgMediaData(array $data)
    {
        $storeData = [];

        foreach ($data as $igMedia) {
            if (@$igMedia['media_type'] != 'IMAGE') {
                continue;
            }

            $existData = self::getEloquentList()
                ->where("ig_media_id", @$igMedia["id"])
                ->first();

            //Dont store exist ig_media_id.
            if ($existData) {
                $existData->url = self::saveInstaImage($igMedia['media_url']);
                $existData->save();
                continue;
            }

            $storeData[] = [
                "ig_media_id" => @$igMedia["id"],
                'url'         => self::saveInstaImage($igMedia['media_url']),
                'alt'         => @$igMedia["caption"] ?? "",
                'caption'     => @$igMedia["caption"] ?? "",
                'tag'         => @$igMedia["shortcode"] ?? "",
                'created_at'  => now(),
                'updated_at'  => now()
            ];
        }

        self::insert($storeData);

        return true;
    }

    static function saveInstaImage($url)
    {
        $basename     = basename(strtok($url, '?'));
        $storage_path = 'public/insta-image/' . $basename;
        if (!Storage::exists($storage_path)) {
            $content = file_get_contents($url);
            Storage::put($storage_path, $content, 'public');
        }
        return '/storage/insta-image/' . $basename;
    }

    public function getImageUrl($size = 'm')
    {
        return $this->url;
        /*if (!$this->ig_media_id) {
            return $this->url;
        }

        if (!$this->tag) {
            return "";
        }

        return "https://www.instagram.com/p/{$this->tag}/media/?size={$size}";*/
    }
}
