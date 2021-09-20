<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("login", "Auth\\LoginController@showLoginForm")->name("login");
Route::post("login", "Auth\\LoginController@login");

Route::group(["middleware" => "auth"], function () {
    Route::get("logout", "Auth\\LoginController@logout")->name("logout");

    Route::get("commands/truncate-ins", 'IgOAuthController@truncate');

    Route::get("", "AdminController@home");
    Route::get("home", "AdminController@home")->name("home");
    Route::get("helpers/get-edit-add-image-field", "AdminController@getEditAddImageField")->name("get_edit_add_image_field");

    //Duplicate
    Route::get('clone/{type}/{id}', 'CloneController@index')->name('clone');

    //Ig
    Route::get("ig/auth", "IgOAuthController@auth")->name("ig.auth");
    Route::get("ig/get-user-media", "IgOAuthController@getUserMedia")->name("ig.get_user_media");

    //Users
    Route::group([
        "prefix" => "users",
        "as" => "users."
    ], function () {
        Route::get("/", "UserController@index")->name("index");
        Route::get("create", "UserController@create")->name("create");
        Route::get("destroy", "UserController@destroy")->name("destroy");
        Route::post("get-table-data", "UserController@getTableData")->name("get_table_data");
        Route::post("/", "UserController@store")->name("store");
        Route::get("{id}/edit", "UserController@edit")->name("edit");
        Route::post("{id}", "UserController@update")->name("update");
    });

    //Languages
    Route::group([
        "prefix" => "languages",
        "as" => "languages."
    ], function () {
        Route::get("/", "LanguageController@index")->name("index");
        Route::get("create", "LanguageController@create")->name("create");
        Route::get("destroy", "LanguageController@destroy")->name("destroy");
        Route::post("get-table-data", "LanguageController@getTableData")->name("get_table_data");
        Route::post("/", "LanguageController@store")->name("store");
        Route::get("{id}/edit", "LanguageController@edit")->name("edit");
        Route::post("{id}", "LanguageController@update")->name("update");
    });

    //Settings
    Route::group([
        "prefix" => "settings",
        "as" => "settings."
    ], function () {
        Route::get("/", "SettingController@index")->name("index");
        Route::get("create", "SettingController@create")->name("create");
        Route::get("{id}/edit", "SettingController@edit")->name("edit");
        Route::get("destroy", "SettingController@destroy")->name("destroy");
        Route::get("configs", "SettingController@configs")->name("configs");

        Route::post("get-table-data", "SettingController@getTableData")->name("get_table_data");
        Route::post("/", "SettingController@store")->name("store");
        Route::post("configs", "SettingController@updateConfigs")->name("update_configs");
        Route::post("{id}", "SettingController@update")->name("update");
    });

    //Menus
    Route::group([
        "prefix" => "menus",
        "as" => "menus."
    ], function () {
        Route::get("/", "MenuController@index")->name("index");
        Route::get("create", "MenuController@create")->name("create");
        Route::get("destroy", "MenuController@destroy")->name("destroy");
        Route::post("get-table-data", "MenuController@getTableData")->name("get_table_data");
        Route::post("/", "MenuController@store")->name("store");
        Route::get("{id}/edit", "MenuController@edit")->name("edit");
        Route::get("{id}/drop-drag", "MenuController@dropDrag")->name("drop_drag");
        Route::post("{id}/drop-drag", "MenuController@sortAfterDropDrag")->name("sort_after_drop_drag");
        Route::post("{id}", "MenuController@update")->name("update");
    });

    //Menu items.
    Route::group([
        "prefix" => "menu-items",
        "as" => "menu_items."
    ], function () {
        Route::get("/", "MenuItemController@index")->name("index");
        Route::get("create", "MenuItemController@create")->name("create");
        Route::get("destroy", "MenuItemController@destroy")->name("destroy");
        Route::get("get-data-language", "MenuItemController@getDataLanguage")->name("get_data_language");
        Route::post("get-table-data", "MenuItemController@getTableData")->name("get_table_data");
        Route::post("/", "MenuItemController@store")->name("store");
        Route::get("{id}/edit", "MenuItemController@edit")->name("edit");
        Route::post("{id}", "MenuItemController@update")->name("update");
    });

    //Pages
    Route::group([
        "prefix" => "pages",
        "as" => "pages."
    ], function () {
        Route::get("/", "PageController@index")->name("index");
        Route::get("create", "PageController@create")->name("create");
        Route::get("destroy", "PageController@destroy")->name("destroy");
        Route::get("get-data-language", "PageController@getDataLanguage")->name("get_data_language");
        Route::post("get-table-data", "PageController@getTableData")->name("get_table_data");
        Route::post("/", "PageController@store")->name("store");
        Route::get("helpers/get-sub-view", "PageController@getSubView")->name("get_sub_view");
        Route::get("{id}/edit", "PageController@edit")->name("edit");
        Route::post("{id}", "PageController@update")->name("update");
    });

    //Has translations tables.
    Route::group([
        "prefix" => "modules",
    ], function () {
        Route::group([
            "prefix" => "properties",
            "as" => "z_properties."
        ], function () {
            Route::get("/", "ZPropertyController@index")->name("index");
            Route::get("create", "ZPropertyController@create")->name("create");
            Route::get("destroy", "ZPropertyController@destroy")->name("destroy");
            Route::get("get-data-language", "ZPropertyController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZPropertyController@getTableData")->name("get_table_data");
            Route::post("/", "ZPropertyController@store")->name("store");
            Route::get("{id}/edit", "ZPropertyController@edit")->name("edit");
            Route::post("{id}", "ZPropertyController@update")->name("update");
        });

        Route::group([
            "prefix" => "cruises",
            "as" => "z_cruises."
        ], function () {
            Route::get("/", "ZCruiseController@index")->name("index");
            Route::get("create", "ZCruiseController@create")->name("create");
            Route::get("destroy", "ZCruiseController@destroy")->name("destroy");
            Route::get("get-data-language", "ZCruiseController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZCruiseController@getTableData")->name("get_table_data");
            Route::post("/", "ZCruiseController@store")->name("store");
            Route::get("{id}/edit", "ZCruiseController@edit")->name("edit");
            Route::post("{id}", "ZCruiseController@update")->name("update");
        });

        Route::group([
            "prefix" => "distributors",
            "as" => "z_distributors."
        ], function () {
            Route::get("/", "ZDistributorController@index")->name("index");
            Route::get("create", "ZDistributorController@create")->name("create");
            Route::get("destroy", "ZDistributorController@destroy")->name("destroy");
            Route::get("get-data-language", "ZDistributorController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZDistributorController@getTableData")->name("get_table_data");
            Route::post("/", "ZDistributorController@store")->name("store");
            Route::get("{id}/edit", "ZDistributorController@edit")->name("edit");
            Route::post("{id}", "ZDistributorController@update")->name("update");
        });

        Route::group([
            "prefix" => "rooms",
            "as" => "z_rooms."
        ], function () {
            Route::get("/", "ZRoomController@index")->name("index");
            Route::get("create", "ZRoomController@create")->name("create");
            Route::get("destroy", "ZRoomController@destroy")->name("destroy");
            Route::get("get-data-language", "ZRoomController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZRoomController@getTableData")->name("get_table_data");
            Route::post("/", "ZRoomController@store")->name("store");
            Route::get("{id}/edit", "ZRoomController@edit")->name("edit");
            Route::post("{id}", "ZRoomController@update")->name("update");
        });

        Route::group([
            "prefix" => "destinations",
            "as" => "z_destinations."
        ], function () {
            Route::get("/", "ZDestinationController@index")->name("index");
            Route::get("create", "ZDestinationController@create")->name("create");
            Route::get("destroy", "ZDestinationController@destroy")->name("destroy");
            Route::get("get-data-language", "ZDestinationController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZDestinationController@getTableData")->name("get_table_data");
            Route::post("/", "ZDestinationController@store")->name("store");
            Route::get("{id}/edit", "ZDestinationController@edit")->name("edit");
            Route::post("{id}", "ZDestinationController@update")->name("update");
        });

        Route::group([
            "prefix" => "durations",
            "as" => "z_durations."
        ], function () {
            Route::get("/", "ZDurationController@index")->name("index");
            Route::get("create", "ZDurationController@create")->name("create");
            Route::get("destroy", "ZDurationController@destroy")->name("destroy");
            Route::get("get-data-language", "ZDurationController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZDurationController@getTableData")->name("get_table_data");
            Route::post("/", "ZDurationController@store")->name("store");
            Route::get("{id}/edit", "ZDurationController@edit")->name("edit");
            Route::post("{id}", "ZDurationController@update")->name("update");
        });

        Route::group([
            "prefix" => "transfers",
            "as" => "z_transfers."
        ], function () {
            Route::get("/", "ZTransferController@index")->name("index");
            Route::get("create", "ZTransferController@create")->name("create");
            Route::get("destroy", "ZTransferController@destroy")->name("destroy");
            Route::get("get-data-language", "ZTransferController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZTransferController@getTableData")->name("get_table_data");
            Route::post("/", "ZTransferController@store")->name("store");
            Route::get("{id}/edit", "ZTransferController@edit")->name("edit");
            Route::post("{id}", "ZTransferController@update")->name("update");
        });

        Route::group([
            "prefix" => "offers",
            "as" => "z_offers."
        ], function () {
            Route::get("/", "ZOfferController@index")->name("index");
            Route::get("create", "ZOfferController@create")->name("create");
            Route::get("destroy", "ZOfferController@destroy")->name("destroy");
            Route::get("get-data-language", "ZOfferController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZOfferController@getTableData")->name("get_table_data");
            Route::post("/", "ZOfferController@store")->name("store");
            Route::get("{id}/edit", "ZOfferController@edit")->name("edit");
            Route::post("{id}", "ZOfferController@update")->name("update");
        });

        Route::group([
            "prefix" => "special-offers",
            "as" => "z_special_offers."
        ], function () {
            Route::get("/", "ZSpecialOfferController@index")->name("index");
            Route::get("create", "ZSpecialOfferController@create")->name("create");
            Route::get("destroy", "ZSpecialOfferController@destroy")->name("destroy");
            Route::get("get-data-language", "ZSpecialOfferController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZSpecialOfferController@getTableData")->name("get_table_data");
            Route::post("/", "ZSpecialOfferController@store")->name("store");
            Route::get("{id}/edit", "ZSpecialOfferController@edit")->name("edit");
            Route::post("{id}", "ZSpecialOfferController@update")->name("update");
        });

        Route::group([
            "prefix" => "banners",
            "as" => "z_banners."
        ], function () {
            Route::get("/", "ZBannerController@index")->name("index");
            Route::get("create", "ZBannerController@create")->name("create");
            Route::get("destroy", "ZBannerController@destroy")->name("destroy");
            Route::get("get-data-language", "ZBannerController@getDataLanguage")->name("get_data_language");
            Route::get("helpers/get-type-models", "ZBannerController@getTypeModels")->name("get_type_models");
            Route::post("get-table-data", "ZBannerController@getTableData")->name("get_table_data");
            Route::post("/", "ZBannerController@store")->name("store");
            Route::get("{id}/edit", "ZBannerController@edit")->name("edit");
            Route::post("{id}", "ZBannerController@update")->name("update");
        });

        Route::group([
            "prefix" => "teams",
            "as" => "z_teams."
        ], function () {
            Route::get("/", "ZTeamController@index")->name("index");
            Route::get("create", "ZTeamController@create")->name("create");
            Route::get("destroy", "ZTeamController@destroy")->name("destroy");
            Route::get("get-data-language", "ZTeamController@getDataLanguage")->name("get_data_language");
            Route::get("helpers/get-type-models", "ZTeamController@getTypeModels")->name("get_type_models");
            Route::post("get-table-data", "ZTeamController@getTableData")->name("get_table_data");
            Route::post("/", "ZTeamController@store")->name("store");
            Route::get("{id}/edit", "ZTeamController@edit")->name("edit");
            Route::post("{id}", "ZTeamController@update")->name("update");
        });

        Route::group([
            "prefix" => "packages",
            "as" => "z_packages."
        ], function () {
            Route::get("/", "ZPackageController@index")->name("index");
            Route::get("create", "ZPackageController@create")->name("create");
            Route::get("destroy", "ZPackageController@destroy")->name("destroy");
            Route::get("get-data-language", "ZPackageController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZPackageController@getTableData")->name("get_table_data");
            Route::post("/", "ZPackageController@store")->name("store");
            Route::get("helpers/get-itinerary-view", "ZPackageController@getItineraryView")->name("get_itinerary_view");
            Route::get("{id}/edit", "ZPackageController@edit")->name("edit");
            Route::post("{id}", "ZPackageController@update")->name("update");
        });

        Route::group([
            "prefix" => "popular_keys",
            "as" => "z_popular_keys."
        ], function () {
            Route::get("/", "ZPopularKeyController@index")->name("index");
            Route::get("create", "ZPopularKeyController@create")->name("create");
            Route::get("destroy", "ZPopularKeyController@destroy")->name("destroy");
            Route::get("get-data-language", "ZPopularKeyController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZPopularKeyController@getTableData")->name("get_table_data");
            Route::post("/", "ZPopularKeyController@store")->name("store");
            Route::get("{id}/edit", "ZPopularKeyController@edit")->name("edit");
            Route::post("{id}", "ZPopularKeyController@update")->name("update");
        });

        Route::group([
            "prefix" => "posts",
            "as" => "z_posts."
        ], function () {
            Route::get("/", "ZPostController@index")->name("index");
            Route::get("create", "ZPostController@create")->name("create");
            Route::get("destroy", "ZPostController@destroy")->name("destroy");
            Route::get("get-data-language", "ZPostController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZPostController@getTableData")->name("get_table_data");
            Route::post("/", "ZPostController@store")->name("store");
            Route::get("{id}/edit", "ZPostController@edit")->name("edit");
            Route::post("{id}", "ZPostController@update")->name("update");
        });

        Route::group([
            "prefix" => "reviews",
            "as" => "z_reviews."
        ], function () {
            Route::get("/", "ZReviewController@index")->name("index");
            Route::get("create", "ZReviewController@create")->name("create");
            Route::get("destroy", "ZReviewController@destroy")->name("destroy");
            Route::get("get-data-language", "ZReviewController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZReviewController@getTableData")->name("get_table_data");
            Route::post("/", "ZReviewController@store")->name("store");
            Route::get("{id}/edit", "ZReviewController@edit")->name("edit");
            Route::post("{id}", "ZReviewController@update")->name("update");
        });

        Route::group([
            "prefix" => "ins-photos",
            "as" => "z_ins_photos."
        ], function () {
            Route::get("/", "ZInsPhotoController@index")->name("index");
            Route::post("/", "ZInsPhotoController@store")->name("store");
            Route::get("destroy", "ZInsPhotoController@destroy")->name("destroy");
            Route::post("get-table-data", "ZInsPhotoController@getTableData")->name("get_table_data");
            Route::get("{id}/edit", "ZInsPhotoController@edit")->name("edit");
            Route::post("{id}", "ZInsPhotoController@update")->name("update");
        });

        Route::group([
            "prefix" => "newsletters",
            "as" => "z_newsletters."
        ], function () {
            Route::get("/", "ZNewsletterController@index")->name("index");
            Route::get("destroy", "ZNewsletterController@destroy")->name("destroy");
            Route::post("get-table-data", "ZNewsletterController@getTableData")->name("get_table_data");
        });

        Route::group([
            "prefix" => "news-types",
            "as" => "z_news_types."
        ], function () {
            Route::get("/", "ZNewsTypeController@index")->name("index");
            Route::get("create", "ZNewsTypeController@create")->name("create");
            Route::get("destroy", "ZNewsTypeController@destroy")->name("destroy");
            Route::get("get-data-language", "ZNewsTypeController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZNewsTypeController@getTableData")->name("get_table_data");
            Route::post("/", "ZNewsTypeController@store")->name("store");
            Route::get("{id}/edit", "ZNewsTypeController@edit")->name("edit");
            Route::post("{id}", "ZNewsTypeController@update")->name("update");
        });

        Route::group([
            "prefix" => "news-posts",
            "as" => "z_news_posts."
        ], function () {
            Route::get("/", "ZNewsPostController@index")->name("index");
            Route::get("create", "ZNewsPostController@create")->name("create");
            Route::get("destroy", "ZNewsPostController@destroy")->name("destroy");
            Route::get("get-data-language", "ZNewsPostController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZNewsPostController@getTableData")->name("get_table_data");
            Route::post("/", "ZNewsPostController@store")->name("store");
            Route::get("{id}/edit", "ZNewsPostController@edit")->name("edit");
            Route::post("{id}", "ZNewsPostController@update")->name("update");
        });

        Route::group([
            "prefix" => "gallery-types",
            "as" => "z_gallery_types."
        ], function () {
            Route::get("/", "ZGalleryTypeController@index")->name("index");
            Route::get("create", "ZGalleryTypeController@create")->name("create");
            Route::get("destroy", "ZGalleryTypeController@destroy")->name("destroy");
            Route::get("get-data-language", "ZGalleryTypeController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZGalleryTypeController@getTableData")->name("get_table_data");
            Route::post("/", "ZGalleryTypeController@store")->name("store");
            Route::get("{id}/edit", "ZGalleryTypeController@edit")->name("edit");
            Route::post("{id}", "ZGalleryTypeController@update")->name("update");
        });

        Route::group([
            "prefix" => "galleries",
            "as" => "z_galleries."
        ], function () {
            Route::get("/", "ZGalleryController@index")->name("index");
            Route::get("create", "ZGalleryController@create")->name("create");
            Route::get("destroy", "ZGalleryController@destroy")->name("destroy");
            Route::get("get-data-language", "ZGalleryController@getDataLanguage")->name("get_data_language");
            Route::post("get-table-data", "ZGalleryController@getTableData")->name("get_table_data");
            Route::post("/", "ZGalleryController@store")->name("store");
            Route::get("{id}/edit", "ZGalleryController@edit")->name("edit");
            Route::post("{id}", "ZGalleryController@update")->name("update");
        });

        Route::group([
            "prefix" => "inquiries",
            "as" => "z_inquiries."
        ], function () {
            Route::get("/", "ZInquiryController@index")->name("index");
            Route::get("destroy", "ZInquiryController@destroy")->name("destroy");
            Route::post("get-table-data", "ZInquiryController@getTableData")->name("get_table_data");
            Route::get("{id}", "ZInquiryController@show")->name("show");
        });

        Route::group([
            "prefix" => "contacts",
            "as" => "z_contacts."
        ], function () {
            Route::get("/", "ZContactController@index")->name("index");
            Route::get("destroy", "ZContactController@destroy")->name("destroy");
            Route::post("get-table-data", "ZContactController@getTableData")->name("get_table_data");
            Route::get("{id}", "ZContactController@show")->name("show");
        });

        Route::group([
            "prefix" => "events",
            "as" => "z_events."
        ], function () {
            Route::get("/", "ZEventController@index")->name("index");
            Route::get("destroy", "ZEventController@destroy")->name("destroy");
            Route::post("get-table-data", "ZEventController@getTableData")->name("get_table_data");
        });
    });
});
