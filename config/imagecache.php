<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}
    |
    | Examples: "images", "img/cache"
    |
    */

    'route' => 'image-cache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submitted
    | by URI.
    |
    | Define as many directories as you like.
    |
    */

    'paths' => array(
        public_path('/'),
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */

    'templates' => array(
        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',

        //Custom templates
        'cruise-item' => 'App\\ImageFilters\\CruiseItem',
        'package-item' => 'App\\ImageFilters\\PackageItem',
        'room-item' => 'App\\ImageFilters\\RoomItem',
        'post-item' => 'App\\ImageFilters\\PostItem',

        'news-post-item' => 'App\\ImageFilters\\NewsPostItem',
        'large-news-post-item' => 'App\\ImageFilters\\LargeNewsPostItem',
        'news-type-item' => 'App\\ImageFilters\\NewsTypeItem',

        'difference-one' => 'App\\ImageFilters\\DifferenceOne',
        'difference-two' => 'App\\ImageFilters\\DifferenceTwo',
        'difference-three' => 'App\\ImageFilters\\DifferenceThree',
        'difference-four' => 'App\\ImageFilters\\DifferenceFour',

        'banner-full' => 'App\\ImageFilters\\BannerFull',

        //static page
        'about-us-main' => 'App\\ImageFilters\\AboutUsMain',
        'about-us-list' => 'App\\ImageFilters\\AboutUsList',
        'meet-our-team' => 'App\\ImageFilters\\MeetOurTeam',
        'sustainable-list' => 'App\\ImageFilters\\SustainableList',
        'character-cruise' => 'App\\ImageFilters\\CharacterCruise',
        'our-client' => 'App\\ImageFilters\\OurClient',

        //gallery page
        'gallery-big-item' => 'App\\ImageFilters\\GalleryBigItem',
        'gallery-item' => 'App\\ImageFilters\\GalleryItem',

        'package-detail-main' => 'App\\ImageFilters\\PackageDetailMain',
        'package-detail-main-side' => 'App\\ImageFilters\\PackageDetailMainSide',
        'package-map' => 'App\\ImageFilters\\PackageMap',

        'loading-logo' => 'App\\ImageFilters\\LoadingLogo',

        //mobile
        'package-gallery-mobile' => 'App\\ImageFilters\\PackageGalleryMobile',

    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */

    'lifetime' => 43200,

);
