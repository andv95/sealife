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

Route::get(transRoute("home"), "Site\\HomeController@home")->name("home");

Route::get(transRoute("cruises.detail"), "Site\\HomeController@getCruise")->name("cruises.detail");

Route::get(transRoute("packages.get_reviews"), "Site\\HomeController@getPackageReviews")->name('packages.get_reviews');
Route::get(transRoute("packages.get_price_and_rooms_by_date"), "Site\\HomeController@getPackagePriceAndRoomsByDate")->name('packages.get_price_and_rooms_by_date');
Route::get(transRoute("packages.detail"), "Site\\HomeController@getPackage")->name('packages.detail');
Route::get(transRoute("packages.send_inquiry"), "Site\\HomeController@getSendInquiry")->name("packages.send_inquiry");
Route::post(transRoute("packages.post_send_inquiry"), "Site\\HomeController@postSendInquiry")->name("packages.post_send_inquiry");
Route::get(transRoute("packages.refresh_send_inquiry"), "Site\\HomeController@refreshSendInquiry")->name("packages.refresh_send_inquiry");

Route::get(transRoute("news_types.list"), "Site\\HomeController@getNewsTypes")->name("news_types.list");
Route::get(transRoute("news_types.get_more_posts"), "Site\\HomeController@getNewsTypePosts")->name("news_types.get_more_posts");
Route::get(transRoute("news_types.detail"), "Site\\HomeController@getNewsType")->name("news_types.detail");
Route::get(transRoute("news_posts.detail"), "Site\\HomeController@getNewsPost")->name("news_posts.detail");

Route::get(transRoute("special_offers.list"), "Site\\HomeController@getSpecialOffers")->name("special_offers");
Route::get(transRoute("special_offers.filters"), "Site\\HomeController@getFilterPackages")->name("special_offers.filters");

Route::get(transRoute("galleries"), "Site\\HomeController@getGalleries")->name("galleries");

Route::get(transRoute("thank_you"), "Site\\HomeController@getThankYou")->name("thank_you");

Route::get(transRoute("pages.detail"), "Site\\HomeController@getPage")->name("pages.detail");



