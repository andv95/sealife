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

//Commands -> php artisan optimize:clear
Route::get("commands/optimize-clear", "Site\\HomeController@optimize_clear");

Route::post("ajax/newsletter", "Site\\HomeController@ajaxNewsLetter")->name("ajax.newsletter");
Route::post("ajax/contact", "Site\\HomeController@ajaxContact")->name("ajax.contact");
Route::post("ajax/event", "Site\\HomeController@ajaxEvent")->name("ajax.event");
Route::post("ajax/rating", "Site\\RatingController@ajax")->name("ajax.rating");

Route::group([
    'as' => 'ajax.package.',
    'namespace' => 'Site',
], function () {
    Route::get('ajax/package/price/min/{package_id}', 'ZPackageController@ajax_package_price_min')->name('price.min');
});

Route::get('imagecache/{template}/{filename}', "Site\\ImageCacheController@index")
    ->name('web.imagecache')
    ->where(['filename' => '[ \w\\.\\/\\-\\@\(\)]+']);
