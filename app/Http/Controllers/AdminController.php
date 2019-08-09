<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
    }
    
    public function defaultAction() {
        $this->pageTitle = "Dashboard";
        $this->iconClass = "fa-tachometer-alt";
        switch( $this->user->role )
        {
            case "SA":
                $this->cont->body = $this->SuperAdmin();
            case "WA":
                $this->cont->body = $this->WebsiteAdmin();
            case "AA":
                $this->cont->body = $this->AreaAdmin();
            case "M":
                $this->cont->body = $this->Manager();
            case "PO":
                $this->cont->body = $this->PropertyOwner();
        }
        return $this->RenderView();
    }

    protected function SuperAdmin()
    {
        return view('admin/index', array(
            "user" => $this->user
        ));
    }

    protected function WebsiteAdmin()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages
        ));
    }

    protected function AreaAdmin()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages
        ));
    }

    protected function Manager()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages
        ));
    }

    protected function PropertyOwner()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages
        ));
    }

    public function viewAsAction()
    {
        if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" && $this->user->role == "SA" )
        {
            $user = \UserLogic::getUser( $_REQUEST['id'] );
            $_SESSION['actual_id'] = $this->user->id;
            $_SESSION['id'] = $user->id;
            return \Redirect::to('Admin')->send();
        }
        $this->pageTitle = "Virtual Session";
        $this->iconClass = "fas fa-user-secret";
        
        $role = \App\Roles::where('code', $this->user->role)->first();
        $roles_ = \App\Roles::where('rank', '>', $role->rank)->get();
        $roles = "";
        foreach ( $roles_ as $row )
        {
            $roles .= "'$row->code' ,";
        }

        $roles = substr($roles, 0, strlen($roles) - 2 );

        $admins = \App\User::whereRaw("role in ($roles) ")->get();
        $this->cont->body = view('admin/viewas', array(
            "admins" => $admins
        ));

        return $this->RenderView();
    }

    public function endViewAsAction()
    {
        $user = \UserLogic::getUser( $_SESSION['actual_id'] );
        unset( $_SESSION['actual_id'] );
        $_SESSION['id'] = $user->id;
        return \Redirect::to('Admin')->send();
    }
}