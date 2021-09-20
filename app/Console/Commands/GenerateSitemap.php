<?php

namespace App\Console\Commands;

use App\Models\ZNewsPost;
use App\Models\ZPackage;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (['vi', 'en'] as $locale) {
            $this->create_sitemap_locale($locale);
        }

        SitemapIndex::create()
            ->add('/sitemap-vi.xml')
            ->add('/sitemap-en.xml')
            ->writeToFile(public_path('sitemap.xml'));
    }

    function create_sitemap_locale($locale)
    {
        $sitemap = Sitemap::create();
        $packages = ZPackage::query()->active()->translatedIn($locale)->orderByDesc('updated_at')->get();
        foreach ($packages as $package) {
            if (!$package->hasTranslation($locale)) {
                continue;
            }
            try {
                $sitemap->add(
                    Url::create(
                        localeRoute('packages.detail', ['slug' => $package->translate($locale)->slug])
                    )->setLastModificationDate($package->updated_at)
                );
            } catch (\Exception $exception) {
                $this->line($locale . ' - package - ' . $package->id);
            }
        }
        $posts = ZNewsPost::query()->active()->translatedIn($locale)->orderByDesc('updated_at')->get();
        foreach ($posts as $post) {
            if (!$post->hasTranslation($locale)) {
                continue;
            }
            try {
                $sitemap->add(
                    Url::create(
                        localeRoute('news_posts.detail', ['slug' => $post->translate($locale)->slug])
                    )->setLastModificationDate($post->updated_at)
                );
            } catch (\Exception $exception) {
                $this->line($locale . ' - post - ' . $post->id);
            }
        }
        $sitemap->writeToFile(public_path('sitemap-' . $locale . '.xml'));
    }
}
