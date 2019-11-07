<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class WebAdminController extends BaseController
{
    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {

        $this->pageTitle = "Website administration";
        $this->cont->body = view("admin/webadmin", array(
            "user" => $this->user
        ));
        return $this->RenderView();
    }
}