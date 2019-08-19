<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class UsersController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        $this->botonera = '<a href="Users.new" class="btn btn-primary"><i class="fas fa-plus"></i> New user</a>';
        $this->pageTitle = "Users";
        $this->iconClass = "fa-users";

        $listado = $this->listadoAction();

        $this->cont->body = view('users/index', array(
            "listado" => $listado
        ));
        return $this->RenderView();
    }

    public function listadoAction()
    {
        $this->data = \App\User::get();

        $this->campos[] = array(
            "title" => "Name",
            "name" => "fullname"
        );
        $this->campos[] = array(
            "title" => "User",
            "name" => "user"
        );
        $this->campos[] = array(
            "title" => "Company",
            "name" => "cc"
        );
        $this->campos[] = array(
            "title" => "Role",
            "name" => "role",
            "width" => "75"
        );

        $this->detailURL = "Users.detail?id=";

        return $this->createTable();
    }

    public function detailAction()
    {
        $this->pageTitle = "Edit user";
        $this->iconClass = "fa-user-edit";
        $this->botonera = view('users/botonera');
        if ( !isset( $_REQUEST['id'] ) ) return \Redirect::to('Users')->send();
        $user = \App\User::where('id', $_REQUEST['id'])->first();
        if ( !is_object( $user ) ) return \Redirect::to('Users')->send();
        $roles = \App\roles::get();
        $companies = \App\Companies::get();
        $this->cont->body = view('users/detail', array(
            "user" => $user,
            "roles" => $roles,
            "companies" => $companies
        ));
        
        return $this->RenderView();
    }

    public function newAction()
    {
        $this->pageTitle = "New user";
        $this->iconClass = "fa-user-plus";
        $this->botonera = view('users/newbotonera');
        $user = new \App\User();
        $roles = \App\roles::get();
        $companies = \App\Companies::get();
        $this->cont->body = view('users/detail', array(
            "user" => $user,
            "roles" => $roles,
            "companies" => $companies
        ));
        return $this->RenderView();
    }
    
    public function saveAction()
    {
        $user = ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" ) ? \App\User::where('id', $_REQUEST['id'])->first() : \App\User::create();
        $user->update( $_REQUEST );
        return \Redirect::to('Users')->send();
    }
}