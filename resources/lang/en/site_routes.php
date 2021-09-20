<?php

use App\Models\Language;

return [
    "home" => "/",
    "cruises" => [
        "detail" => Language::PRE_URL_CRUISE . "/{slug}"
    ],
    "packages" => [
        "detail" => "packages/{slug?}",
        "get_reviews" => "packages/get-reviews",
        "get_price_and_rooms_by_date" => "packages/get-price-and-rooms-by-date",
        "send_inquiry" => 'send-inquiry',
        "post_send_inquiry" => 'send-inquiry',
        "refresh_send_inquiry" => 'send-inquiry/refresh',
    ],
    "news_types" => [
        "list" => "blog",
        "get_more_posts" => "blog/get-more-posts",
        "detail" => "blog/{slug}",
    ],
    "news_posts" => [
        "detail" => Language::PRE_URL_NEWS_POST . "/{slug}"
    ],
    "special_offers" => [
        "list" => 'special-offers',
        "filters" => 'special-offers/filters'
    ],
    "pages" => [
        "detail" => '{slug}',
    ],
    "galleries" => 'gallery/{slug?}',
    "thank_you" => '{type}/success',
];
