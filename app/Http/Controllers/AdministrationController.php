<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use \App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Support\Facades\DB;
use \App\Providers\TranslationProvider;

use \App\LogOperaciones;
use \App\Messages;

class AdministrationController extends BaseController
{
    public function __construct() {
        $this->user = \App\User::where('id', $_SESSION["id"])->first();
        parent::__construct();
    }

    protected function setHeaderAndFooter()
    {
        $types = \App\TaskType::get();
        $notifications = \App\Notifications::getUnseenForUser();
        $count = ( is_null( $notifications ) ) ? 0 : count( $notifications );

        $this->cont->footer = view('layout/footer_admin');
        $this->cont->sidebar = view("layout/admin_sidebar", array(
            "types" => $types
        ));
        $this->cont->header = view('layout/admin_header', array(
            "notifications" => $notifications,
            "count_notifications" => $count
        ));
    }
    
    protected function RenderView() {
        $_SESSION['errors'] = "";
        $template =  "layout/app_admin";
        return view($template, array(
            "sidebar" => $this->cont->sidebar,
            "navbar" => $this->cont->header,
            "content" => $this->cont->body,
            "footer" => $this->cont->footer,
            "pageTitle" => $this->pageTitle,
            "iconClass" => $this->iconClass,
            "botonera" => $this->botonera
        ));
    }

}
