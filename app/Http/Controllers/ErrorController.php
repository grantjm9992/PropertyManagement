<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class ErrorController extends BaseController
{

    public function __construct() {
        if ( isset( $_SESSION['id'] ) ) $this->secure = 1;
        parent::__construct();
    }
    
    public function defaultAction() {
        $this->cont->body = view('error/index');
        return $this->RenderView();
    }

    public function loggedAction()
    {
        $this->cont->body = view('error/logged');
        return $this->RenderView();
    }

}