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


Route::get('/', 'FnxFrontendController@showHome');

Route::get('theme.css', 'FnxFrontendController@themeCSS');

Route::any('{lang}/{url}.html','FnxFrontendController@decodeUrl')->where(['url' => '[A-Za-z0-9_/-]+']);
Route::any('{lang}','FnxFrontendController@showHome')->where(['lang' => '[a-z]{2}']);


Route::group(['prefix' => config('backpack.base.route_prefix'), 'middleware' => ['admin']], function () {
    Route::crud('menu-item', 'Admin\FnxMenuItemCrudController');

    Route::get('translates/list','Admin\FnxTranslateController@list');
    Route::get('translates/scan','Admin\FnxTranslateController@scan');
    Route::post('translates/save','Admin\FnxTranslateController@save');

});

Route::post('subscribe','FnxFrontendController@subscribe');
Route::post('contact','FnxFrontendController@contact');

Route::get('accept-cookies','FnxFrontendController@acceptCookies');
Route::get('toggle-cookies','FnxFrontendController@toggleCookies');
Route::any('robots.txt', 'FnxFrontendController@robots');
Route::get('sitemap.xml','FnxFrontendController@sitemap');


Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => '\App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('fnxcookie', 'FnxCookieCrudController');
    Route::crud('fnxcookiecategory', 'FnxCookieCategoryCrudController');
}); // this should be the absolute last line of this file

