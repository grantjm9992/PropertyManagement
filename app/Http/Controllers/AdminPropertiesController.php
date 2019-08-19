<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminPropertiesController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        if ( is_object( $this->user ) && $this->user->profile == "WA" ) return $this->skinsAction();
    }
    

    public function defaultAction() {
        $this->pageTitle = "Properties";
        $this->iconClass = "fa-home";
        $this->botonera = '<a href="AdminProperties.new" class="btn btn-primary"><i class="fas fa-plus"></i> New Company</a>';

        $listado = $this->listadoAction();

        $this->cont->body = view('adminproperties/index', array(
            "listado" => $listado
        ));
        return $this->RenderView();
    }
    
    public function listadoAction()
    {
        $this->data = \App\Properties::whereRaw( $this->makeWhere() )->get();
        $this->campos[] = array(
            "title"=> "Name",
            "name" => "title"
        );
        $this->detailURL = "AdminProperties.detail?id=";
        return $this->createTable();
    }

    protected function makeWhere()
    {

        $where = " 1 ";

        if ( $this->user->role == "FA" )
        {
            $where .= " AND id_company = ".$this->user->id_company." ";
        }
        if ( $this->user->role == "AA" )
        {
            $where .= " AND id_area = ".$this->user->id_area." ";
        }
        if ( $this->user->role == "M" )
        {
            $where .= " AND id_assigned_to = ".$this->user->id." ";
        }
        if ( $this->user->role == "PO" )
        {
            $where .= " AND id_property_owner = ".$this->user->id." ";
        }

        return $where;
    }

    public function newAction()
    {
        $company = new \App\Companies();
        $this->pageTitle = "New Company";
        $this->iconClass = "fa-briefcase";
        $this->botonera = view('companies/editbotonera');

        $this->cont->body = view('companies/detail', array(
            "company" => $company
        ));

        return $this->RenderView();
    }

    public function detailAction()
    {
        $this->pageTitle = "Manage Property";
        $this->iconClass = "fas fa-home";
        $this->cont->body = "";

        return $this->RenderView();
    }

    public function saveAction()
    {
        if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" )
        {
            $company = \App\Companies::where('id', $_REQUEST['id'])->first();
            $company->update($_REQUEST);
        }
        else
        {
            $date = new \DateTime();
            $company = \App\Companies::create($_REQUEST);
            $company->date_created = $date->format('Y-m-d H:i:s');
            $company->save();
        }

        return \Redirect::to('AdminCompanies')->send();
    }

    public function deleteAction()
    {
        $company = \App\Companies::where('id', $_REQUEST['id'])->first();

        if ( $company->isEmpty() )
        {
            $company->delete(); 
            return "OK";
        }
    }

    public function skinsAction()
    {
        $this->botonera = view('companies/skinbotonera');
        $this->pageTitle = "Edit theme";
        $this->iconClass = "fa-palette";
        $skin = $this->user->getCompanySkin();
        $this->cont->body = view('companies/skins', array(
            "skin" => $skin
        ));

        return $this->RenderView();
    }

    public function saveSkinAction()
    {
        $skin = \App\Skins::where('id', $_REQUEST['id'])->first();
        $skin->update( $_REQUEST );
        return \Redirect::to('Admin')->send();
    }

    public function uploadLogoAction()
    {
        if (!empty($_FILES)) {
            
            $tempFile = $_FILES['file']['tmp_name'];
            $id = $_REQUEST['id'];

            $targetDir = "img/companies/$id/";
            if (!is_dir( $targetDir ) )
            {
                mkdir( $targetDir, 0777, true );
            }
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $skin = \App\Skins::where('id', $id)->first();
            $skin->logo = $targetDir."logo.$ext";
            $skin->save();

            move_uploaded_file($tempFile , $skin->logo);
        }       

    }

    public function removeLogoAction()
    {
        $id = $_REQUEST['id'];
        $skin = \App\Skins::where('id', $id)->first();
        \unlink( $skin->logo );
        $skin->logo = "";
        $skin->save();
        return "OK";
    }

    public function removeSkinAction()
    {
        $id = $_REQUEST['id'];
        $skin = \App\Skins::where('id', $id)->first();
        \unlink ( $skin->logo );
        $skin->delete();
        return "OK";
    }
}