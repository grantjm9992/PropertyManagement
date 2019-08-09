<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Translations;

class TranslationProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function __construct() {

    }

    public static function get_translation($key)
    {
        if ( isset($_COOKIE['connecto_couriers_locale']) && $_COOKIE['connecto_couriers_locale'] != "" ) {
            $locale = $_COOKIE['connecto_couriers_locale'];
        } else {
            $locale = "en";
        }
        $results = Translations::where('key', $key)
                                ->where('locale', $locale)
                                ->first();
        
        if ( is_object( $results ) ) {
            return $results->text;
        } else {
            return "";
        }
    }

    public function get($key) {
        if ( isset($_COOKIE['connecto_couriers_locale']) && $_COOKIE['connecto_couriers_locale'] != "" ) {
            $locale = $_COOKIE['connecto_couriers_locale'];
        } else {
            $locale = "en";
        }
        $results = Translations::where('key', $key)
                                ->where('locale', $locale)
                                ->first();
        
        if ( is_object( $results ) ) {
            return $results->text;
        } else {
            return "";
        }
    }
}
