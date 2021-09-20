<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageCacheController extends Controller
{
    protected $files;

    /**
     * Create a new controller instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function index(Request $request, $template, $filename)
    {
        //check webp
        $webp = false;
        if (Str::endsWith($filename, '.webp')) {
            $webp     = true;
            $filename = Str::replaceLast('.webp', '', $filename);
        }

        $size = $this->getSize($template);
        if (!$size || !$this->files->exists($filename)) {
            abort('404', 'not size or file');
        }
        $cache_img      = public_path('imagecache/' . $template . '/' . $filename);
        $cache_filename = $cache_img . ($webp ? '.webp' : '');
        if ($this->files->exists($cache_filename)) {
            return Image::make($cache_filename)->response();
        }
        $path = $this->files->dirname($cache_filename);
        $this->files->makeDirectory($path, 0777, true, true);

        //
        if ($webp && $this->files->exists($cache_img)) {
            $img = Image::make($cache_img);
        } else {
            $img = Image::make($filename);
        }
        if ($size[2] == 'fit') {
            $img->fit($size[0], $size[1]);
        } elseif ($size[2] == 'resize') {
            $img->resize($size[0], $size[1], function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            abort('404');
        }
        if ($webp) {
            $img->encode('webp');
        }
        $img->save($cache_filename, 80);
        return Image::make($cache_filename)->response();
    }

    function getSize($template)
    {
        $responsive = 0;
        $size       = [];
        $sizes      = config('site_image.sizes', []);
        if (isset($sizes[$template])) {
            $size = $sizes[$template];
        }
        // responsive
        foreach (config('site_image.responsive', []) as $key) {
            if (Str::endsWith($template, '-' . $key)) {
                $base_template = Str::replaceLast('-' . $key, '', $template);
                if (isset($sizes[$base_template])) {
                    $size       = $sizes[$base_template];
                    $responsive = $key;
                }
                break;
            }
        }
        if (!$size) {
            return false;
        }
        if ($responsive && $size[0] > $responsive) {
            if ($size[0] && !$size[1]) {
                $size[0] = $responsive;
            } elseif ($size[0] && $size[1]) {
                $ratio   = $size[0] / $size[1];
                $size[0] = $responsive;
                $size[1] = round($responsive / $ratio);
            }
        }

        return $size;
    }
}
