<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminController extends BaseController
{

    protected $widgets;
    protected $translator;

    public function __construct() {
        parent::__construct();
        $this->translator = new TranslationProvider();
    }
    
    public function defaultAction() {
        list($leftWidgets, $rightWidgets) = \WidgetsUser::getWidgets();
        $this->cont->body = view('admin/index', array(
            "user" => $this->user,
            "leftwidgets" => $leftWidgets,
            "rightwidgets" => $rightWidgets
        ));
        return $this->RenderView();
    }

    protected function SuperAdmin()
    {
        list($leftWidgets, $rightWidgets) = \WidgetsUser::getWidgets();
        view('admin/index', array(
            "user" => $this->user,
            "leftwidgets" => $leftWidgets,
            "rightWidgets" => $rightWidgets
        ));
    }

    protected function WebsiteAdmin()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages,
            "widgets" => $this->widgets
        ));
    }

    protected function AreaAdmin()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages,
            "widgets" => $this->widgets
        ));
    }

    protected function Manager()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages,
            "widgets" => $this->widgets
        ));
    }

    protected function PropertyOwner()
    {
        $arrivals = "";
        $messages = "";
        return view('admin/index', array(
            "user" => $this->user,
            "arrivals" => $arrivals,
            "messages" => $messages,
            "widgets" => $this->widgets
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