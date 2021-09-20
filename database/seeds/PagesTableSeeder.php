<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            Page::PAGE_FIXED_HOME => 'Home',
            Page::PAGE_FIXED_NEWS_TYPE_LIST => 'News Category List',
            Page::PAGE_FIXED_SPECIAL_OFFERS => 'Special Offers',
            Page::PAGE_FIXED_SEND_INQUIRY => 'Send Inquiry',
        ];

        foreach ($pages as $fixedSlug => $globalName) {
            if (!DB::table("pages")->where("fixed_slug", $fixedSlug)->count()) {
                DB::table("pages")->insert([
                    'global_name' => $globalName,
                    'fixed_slug' => $fixedSlug,
                    'active_flg' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
