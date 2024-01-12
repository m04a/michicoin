<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FnxSettings;
use App\Models\Theme;

use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            Config::set('fnx_settings',FnxSettings::get());
            $forceSSL = getSetting('seo_ssl');
            if($forceSSL){
                \URL::forceScheme('https');
            }
            $theme = Theme::where('default',1)->first();
            if(!$theme){
                $theme = Theme::first();
            }
            if($theme){
                Config::set('theme_extras',$theme->extras);
                Config::set('theme_content',$theme->content);
            }
        }
        catch(\Exception $e){
            
        }

        $app_locale = Config::get('app.locale');
        $default_locale = getSetting('general_default_lang',FALSE,$app_locale);
        Config::set('app.locale',$default_locale);
        
    }
}
