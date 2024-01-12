<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('entry', 'EntryCrudController');
    Route::crud('page', 'PageCrudController');
    Route::crud('menu-item', 'FnxMenuItemCrudController');

    Route::crud('subscriber', 'SubscriberCrudController');
    Route::get('subscriber/export/{format}','SubscriberCrudController@export');
    Route::crud('fnxsettings', 'FnxSettingsCrudController');

    Route::get('clearmedia', 'AdminController@clearmedia');

    //Config email
    Route::get('email/config','AdminEmailController@config');
    Route::post('email/save','AdminEmailController@save');
    Route::post('email/test','AdminEmailController@test');


    //SOLO ROOT
    Route::group([
        'middleware' => [
            '\App\Http\Middleware\checkRoot'
        ],
    ], function () { // custom admin routes
        Route::crud('theme', 'ThemeCrudController');
        Route::crud('help', 'HelpCrudController');
        Route::crud('helpcat', 'HelpcatCrudController');    
    });
    Route::crud('contact-send', 'ContactSendCrudController');
    Route::get('contact-send/readall', 'ContactSendCrudController@Readall');

    Route::get('help/see','HelpCrudController@see');
    Route::crud('redirection', 'RedirectionCrudController');
}); // this should be the absolute last line of this file