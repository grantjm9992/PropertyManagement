<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminCompaniesController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        if ( isset( $_SESSION['id'] ) && $_SESSION['id'] != "" ) $this->user = \UserLogic::getUser();
        if ( is_object( $this->user ) && $this->user->profile == "WA" ) return $this->skinsAction();
    }
    

    public function defaultAction() {
        $this->pageTitle = "Companies";
        $this->iconClass = "fa-briefcase";
        $this->botonera = '<a href="AdminCompanies.new" class="btn btn-primary"><i class="fas fa-plus"></i> New Company</a>';

        $listado = $this->listadoAction();

        $this->cont->body = view('companies/index', array(
            "listado" => $listado
        ));
        return $this->RenderView();
    }
    
    public function listadoAction()
    {
        $this->data = \App\Companies::orderBy('name', 'ASC')->get();
        $this->campos[] = array(
            "title"=> "Name",
            "name" => "name"
        );
        $this->detailURL = "AdminCompanies.detail?id=";
        return $this->createTable();
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
        if ( !isset( $_REQUEST['id'] ) ) return \Redirect::to('AdminCompanies')->send();
        $id = $_REQUEST['id'];
        $company = \App\Companies::where('id', $id)->first();
        $this->pageTitle = "Edit Company";
        $this->iconClass = "fa-briefcase";
        $this->botonera = view('companies/editbotonera');
        if ( !is_object( $company ) ) return \Redirect::to('AdminCompanies')->send();

        $this->cont->body = view('companies/detail', array(
            "company" => $company
        ));

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
            \AppConfig::companyCreate( $company );
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
        $skin->version = (int)$skin->version + 1;
        $skin->save();

        $this->createSkin( $skin );

        return \Redirect::to('WebAdmin')->send();
    }

    protected function createSkin( $skin )
    {
        $style_file = \file_get_contents("css/style_template.css");
        $style_file = str_replace("@headerFontColour", $skin->t1, $style_file);
        $style_file = str_replace("@headerBGColour", $skin->c1, $style_file);
        $style_file = str_replace("@footerFontColour", $skin->t2, $style_file);
        $style_file = str_replace("@footerBGColour", $skin->c2, $style_file);
        $style_file = str_replace("@accentFontColour", $skin->t3, $style_file);
        $style_file = str_replace("@accentBGColour", $skin->c3, $style_file);
        \file_put_contents("css/style_.css", $style_file);
        

        $style_file = \file_get_contents("css/resorts_template.css");
        $style_file = str_replace("@headerFontColour", $skin->t1, $style_file);
        $style_file = str_replace("@headerBGColour", $skin->c1, $style_file);
        $style_file = str_replace("@footerFontColour", $skin->t2, $style_file);
        $style_file = str_replace("@footerBGColour", $skin->c2, $style_file);
        $style_file = str_replace("@accentFontColour", $skin->t3, $style_file);
        $style_file = str_replace("@accentBGColour", $skin->c3, $style_file);

        \file_put_contents("css/resorts.css", $style_file);
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
            if ( file_exists($skin->logo ) ) \unlink( $skin->logo );
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

    public function contactInformationAction()
    {
        $this->pageTitle = "Update contact details";
        $this->iconClass = "fas fa-address-book";
        $this->botonera = view("comun/standardbtn", array( "url" => url("WebAdmin") ) );
        $company = \App\Companies::where("id", $this->user->id_company)->first();
        $this->cont->body = view("admin/companycontact", array(
            "company" => $company
        ));
        return $this->RenderView();
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