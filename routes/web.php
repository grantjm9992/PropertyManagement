<?php
session_start();

function getURL($slug)
{
    if ( strpos( $slug, '-') !== false )
    {
        $slug = str_replace('-', '', $slug);
    }
    if ( strpos( $slug, '?') !== false ) {
        $slug = substr($slug, 0, strpos($slug, "?"));
    }
    if ( strpos($slug, ".") !== false ) {
        $r = substr($slug, 0, strpos($slug, "."));
        $action = substr($slug, strpos($slug, ".") + 1);
        if ( strpos($action, "/") !== false ) {
            $action = substr($action, 0, strpos($action, "/") );
        }
    } else {
        $r = $slug;
        $action = "default";
    }

    if ( $slug == "/" | $slug == "" ) {
        $r = "Home";
    }
    $controller = "\App\Http\Controllers\\".$r."Controller";
    if ( !class_exists($controller) ) {
        $controller = "\App\Http\Controllers\\FourOFourController";
    }
    $controller_instance = new $controller;
    $action .= "Action";

    return  array($controller_instance, $action);
}

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

use App\User;
Route::any('{page}', function($slug) {
    list($controller, $action) = getURL($slug);
    return $controller->$action();
});
Route::any('/', function() {
    $controller = "\App\Http\Controllers\HomeController";
    $instance = new $controller();
    return $instance->defaultAction();
});