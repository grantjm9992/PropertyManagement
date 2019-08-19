<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class PoliciesController extends BaseController
{

    public function __construct() {
        parent::__construct();
    }
    
    public function cookiesAction() {
        $this->cont->body = view('policies/cookies');
        return $this->RenderView();
    }

    public function privacyAction()
    {
        $this->cont->body = view('policies/privacy');
        return $this->RenderView();        
    }
}