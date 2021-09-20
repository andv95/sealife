<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        DB::table("setting_translations")->truncate();
        DB::table("settings")->truncate();
        $inserts = [];
        $orderNo = 0;

        foreach ($this->getSettings() as $key => $setting) {
            $inserts[] = [
                "key" => $key,
                "display_name" => $setting[0],
                "group" => $setting[1],
                "type" => $setting[2],
                "language_flg" => $setting[3],
                "order_no" => $orderNo
            ];

            $orderNo++;
        }

        DB::table("settings")->insert($inserts);

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        \Illuminate\Support\Facades\Artisan::call("optimize:clear");
    }

    public function getSettings(): array
    {
        return [
            "shop_name" => ["Tên cửa hàng", Setting::GROUP_SITE, Setting::TYPE_TEXT, true],
            "phone_1" => ["Số điện thoại 1", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],
            "phone_2" => ["Số điện thoại 2", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],
            "social_fb" => ["Facebook link", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],
            "social_tw" => ["Twitter link", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],
            "social_yt" => ["Youtube link", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],
            "social_ins" => ["Instagram link", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],
            "copy_right" => ["Copy right", Setting::GROUP_SITE, Setting::TYPE_TEXT, true],
            "logo" => ["Logo", Setting::GROUP_SITE, Setting::TYPE_IMAGE, false],
            "favi_icon" => ["Favi icon", Setting::GROUP_SITE, Setting::TYPE_IMAGE, false],
            "tripadvisor" => ["Tripadvisor", Setting::GROUP_SITE, Setting::TYPE_IMAGE, false],
            "instagram_text" => ["Instagram text button", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],
            "text_404" => ["SORRY,THE REQUESTED URL WAS NOT FOUND", Setting::GROUP_SITE, Setting::TYPE_TEXTAREA, false],
            "email_received" => ["Email received", Setting::GROUP_SITE, Setting::TYPE_TEXT, false],

            "property_title_1" => ["Title Property 1", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "property_subtitle_1" => ["Subtitle Property 1", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "property_excerpt_1" => ["Mô tả Property 1", Setting::GROUP_SITE_HOME, Setting::TYPE_CK_EDITOR, true],
            "search_head" => ["Tiêu đề thanh tìm kiếm", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "search_most_popular" => ["Phổ biến nhất", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],

            "the_sea_group" => ["THE SEA GROUP", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "differences" => ["Differences", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "differences_photos" => ["Difference photos", Setting::GROUP_SITE_HOME, Setting::TYPE_MULTI_IMAGES, true],

            "sea_group_content" => ["THE SEA GROUP Content", Setting::GROUP_SITE_HOME, Setting::TYPE_CK_EDITOR, true],
            "review_head" => ["WHAT GUESTS TALK", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXTAREA, true],

            "review_sub_head" => ["About Us", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXTAREA, true],
            "gallery_head" => ["LATEST in #HalongBay", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "newsletter_head" => ["SIGN UP FOR", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "newsletter_sub" => ["Special offers", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],

            "property_title_2" => ["Title Property 2", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "property_subtitle_2" => ["Subtitle Property 2", Setting::GROUP_SITE_HOME, Setting::TYPE_TEXT, true],
            "property_excerpt_2" => ["Mô tả Property 2", Setting::GROUP_SITE_HOME, Setting::TYPE_CK_EDITOR, true],

            //setting for cruise page
            "cruise_room_head" => ["Cruise room head", Setting::GROUP_SITE_CRUISE, Setting::TYPE_TEXT, true],
            "cruise_package_head" => ["Cruise package head", Setting::GROUP_SITE_CRUISE, Setting::TYPE_TEXT, true],
            "cruisePackageContent" => ["Cruise package content", Setting::GROUP_SITE_CRUISE, Setting::TYPE_TEXTAREA, true],
            "cruiseExperienceHead" => ["Cruise experience head", Setting::GROUP_SITE_CRUISE, Setting::TYPE_TEXT, true],
            "cruiseExContent" => ["Cruise experience content", Setting::GROUP_SITE_CRUISE, Setting::TYPE_TEXTAREA, true],

            //setting for package page
            "tripadvisor_reviews" => ["Tripadvisor reviews", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "pkPriceInclusion" => ["Price Inclusion", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "pkPriceExclusion" => ["Price Exclusion", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "pkCruisePolicy" => ["Cruise Policy", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "pkBookingPolicy" => ["Booking Policy", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "pk_best_rate" => ["LOCK IN THE BEST RATE", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "on_activity_head" => ["On activity head", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "on_activity_content" => ["On activity content", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "view_more_price_options" => ["View more price options", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "packageDownloadHead" => ["Package download head", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],
            "PKDownloadContent" => ["Package download content", Setting::GROUP_SITE_PACKAGE, Setting::TYPE_TEXT, true],

            //setting for news page
            "head_news_page" => ["Head news page", Setting::GROUP_SITE_NEWS, Setting::TYPE_TEXT, true],
            "content_news_page" => ["Content news page", Setting::GROUP_SITE_NEWS, Setting::TYPE_TEXTAREA, true],
            "relate_article" => ["RELATED ARTICLE", Setting::GROUP_SITE_NEWS, Setting::TYPE_TEXT, true],
            "latest_article" => ["LATEST ARTICLE", Setting::GROUP_SITE_NEWS, Setting::TYPE_TEXT, true],

            //setting for inquiry page
            "1_review_inquiry" => ["1 review inquiry", Setting::GROUP_SITE_INQUIRY, Setting::TYPE_TEXT, true],
            "2_transfer_service" => ["2 transfer service", Setting::GROUP_SITE_INQUIRY, Setting::TYPE_TEXT, true],
            "3_contact_detail" => ["3 contact detail", Setting::GROUP_SITE_INQUIRY, Setting::TYPE_TEXT, true],
            "3_contact_content" => ["3 contact content", Setting::GROUP_SITE_INQUIRY, Setting::TYPE_TEXTAREA, true],

            //setting for other page
            "current_travel" => ["CURRENT TRAVEL Deals", Setting::GROUP_SITE_OTHER, Setting::TYPE_TEXT, true],
        ];
    }
}
