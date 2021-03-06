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
        $where = " 1 ";
        if (isset($_REQUEST["name"]) && $_REQUEST["name"] != "" ) $where .= " AND (name LIKE '%".$_REQUEST["name"]."%' or surname LIKE '%".$_REQUEST["name"]."%' ) ";
        if (isset($_REQUEST["email"]) && $_REQUEST["email"] != "" ) $where .= " AND email LIKE '%".$_REQUEST["email"]."%' ";
        if (isset($_REQUEST["phone"]) && $_REQUEST["phone"] != "" ) $where .= " AND phone LIKE '%".$_REQUEST["phone"]."%' ";
        if ( (int)$this->user->id_company !== -1 ) $where .= " AND id_company = ".$this->user->id_company;
        $this->data = \App\User::whereRaw( $where )->get();
        foreach ( $this->data as $row )
        {
            $row->fullname = $row->name." ".$row->surname;
            $company = \App\Companies::where('id', $row->id_company)->first();
            $row->cc = ( is_object( $company ) ) ? $company->name : "";
        }

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
        if ( !isset( $_REQUEST['id'] ) ) return \Redirect::to('Users')->send();
        $user = \App\User::where('id', $_REQUEST['id'])->first();
        if ( !is_object( $user ) ) return \Redirect::to('Users')->send();
        $whereRaw = ($this->user->role != "SA" ) ? "RANK > 3" : "1";
        $roles = \App\Roles::whereRaw($whereRaw)->get();
        $companies = \App\Companies::get();
        $this->botonera = view('users/botonera', array(
            "user" => $this->user,
            "thisUser" => $user
        ));
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
        $whereRaw = ($this->user->role != "SA" ) ? "RANK > 3" : "1";
        $roles = \App\Roles::whereRaw($whereRaw)->get();
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
        if ( isset( $_REQUEST["password"] ) && $_REQUEST["password"] != "" ) $user->password = md5($_REQUEST["password"]);
        $user->save();
        return \Redirect::to('Users')->send();
    }


    public function getMentionAction()
    {
        $user = $_REQUEST["title"];
        $where = "";
        if ( isset ( $_REQUEST["role"] ) && $_REQUEST["role"] != "" ) $where .= " AND role='".$_REQUEST["role"]."' ";
        if ( isset ( $_REQUEST["assignproperty"] ) && $_REQUEST["assignproperty"] != "" ) $where .= " AND role IN ('M', 'AA') ";
        if ( isset ( $_REQUEST["mycompany"] ) && $_REQUEST["mycompany"] != "" && $this->user->id_company !== -1 ) $where .= " AND  id_company = ".$this->user->id_company;
        $contacts = \App\User::whereRaw(" (name LIKE '%$user%' OR surname LIKE '%$user%') $where ")->get();
        
        $return = array();
        foreach ( $contacts as $contact )
        {
            $fullname = strtoupper( $contact->name." ".$contact->surname );
            $fullname = str_replace(strtoupper($user), strtoupper("<b>$user</b>"), $fullname);

            $con = array();
            $con["id"] = $contact->id;
            $con["title"] = $fullname;
            array_push($return, $con);
        }
        die(json_encode($return));
    }

    public function updateForNotificationsAction()
    {
        $id = $_REQUEST["id"];
        $user = \App\User::where("id", $id)->first();
        $user->notify_email = $_REQUEST["notify_email"];
        $user->email = $_REQUEST["email"];
        $user->save();
    }
}