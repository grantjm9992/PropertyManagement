<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminInfoSectionsController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
    }
    

    public function defaultAction() {
        $this->pageTitle = "Information Sections";
        $this->iconClass = "fa-info-circle";

        $this->cont->body = view('admin/infosections/index', array(
            
        ));
        return $this->RenderView();
    }
}