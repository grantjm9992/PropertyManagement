<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Trads;

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
        if ( isset($_COOKIE['prop_m_locale']) && $_COOKIE['prop_m_locale'] != "" ) {
            $locale = $_COOKIE['prop_m_locale'];
        } else {
            $locale = "en";
        }
        $results = Trads::where('key', $key)
                                ->where('locale', $locale)
                                ->first();
        
        if ( is_object( $results ) ) {
            return $results->text;
        } else {
            return "";
        }
    }

    public function get($key) {
        if ( isset($_COOKIE['prop_m_locale']) && $_COOKIE['prop_m_locale'] != "" ) {
            $locale = $_COOKIE['prop_m_locale'];
        } else {
            $locale = "en";
        }
        $results = Trads::where('key', $key)
                                ->where('locale', $locale)
                                ->first();
        
        if ( is_object( $results ) ) {
            return $results->text;
        } else {
            return "";
        }
    }

    public function getLocale()
    {
        if ( isset($_COOKIE['prop_m_locale']) && $_COOKIE['prop_m_locale'] != "" ) {
            if ( in_array( $_COOKIE['prop_m_locale'], $this->getLocales() ) ) return $_COOKIE['prop_m_locale'];
        }
        $locales = $this->getLocales();
        return $locales[0];
    }

    public function getLocales()
    {
        return array('en', 'es');
    }

    public static function _getLocales()
    {
        return array('en', 'es');
    }

    public function setLocale($locale)
    {
        $locales = $this->getLocales();
        if ( in_array( $locale, $locales ) )
        {
            setcookie("prop_m_locale", $locale);
        }
        else
        {
            setcookie("prop_m_locale", $locales[0]);
        }
    }

    public static function _setLocale($locale)
    {
        $locales = self::_getLocales();
        if ( in_array( $locale, $locales ) )
        {
            setcookie("prop_m_locale", $locale);
        }
        else
        {
            setcookie("prop_m_locale", $locales[0]);
        }
    }
}
