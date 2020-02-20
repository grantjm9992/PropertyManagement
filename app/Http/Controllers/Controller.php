<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Support\Facades\DB;
use \App\Providers\TranslationProvider;

use \App\LogOperaciones;
use \App\Messages;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // Catch all errors
    protected $errors;
    // Initiate translations;
    protected $translator;
    // cont->body es el contenido
    protected $cont;
    // titulo que sale en la pestaña.
    protected $title;
    // Si hay que construir una tabla
    protected $campos;
    protected $gridId;
    protected $ancho_tabla;
    protected $altura_tabla;
    protected $data;
    protected $dataID;
    protected $detailURL;
    protected $buscador;
    protected $pageSize;
    protected $urlNew;


    public $headerClass = "default-color";
    public $controller;
    public $tableTemplate;
    public $columns;
    public $page_size;
    public $table;
    public $successFunction;

    public $bodyClass;

    public $selectIds = "";

    // Para cada página. Botonera será para añadir, volver, guardar, borrar... etc.
    protected $pageTitle;
    protected $iconClass;
    protected $botonera;

    //For public pages
    protected $secure = 0;
    protected $set_menu = "<script src='js/set-menu.js'></script>";

    public function __construct() {
        $this->cont = new \ArrayObject();
        $this->campos = array();
        $this->title = env("APPLICATION_NAME");
        $this->keywords = "";
        $this->selectIds = "@#";
        $this->description = "My Casa Away";
        $this->pageTitle = "";
        $this->botonera = "";
        $this->iconClass = "";
        $this->gridId = "grid_content";
        $this->ancho_tabla = "100%";
        $this->altura_tabla = "auto";
        $this->dataID = "id";
        $this->detailURL = "";
        $this->pageSize = 12;
        $this->buscador = "";
        $this->translator = new TranslationProvider();
        $this->errors = "";
        $this->bodyClass = "bodyMargin bg-light";

        
        /* DEFAUTL GRID PARAMS */
        $this->tableTemplate = 'comun/grid';
        $this->gridId = "grid";
        $this->page_size = 50;
        $this->successFunction = "";
        $this->body = "";
        $this->setErrors();
    }

    protected function setErrors()
    {
        $html = "";
        if ( isset ( $_SESSION['errors'] ) ) {
            $error_string = $_SESSION['errors'];
            $error_array = explode('@#', $error_string, -1);
            foreach ( $error_array as $error )
            {
                $html .= '<p><div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$error.'</div></p>';
            }
            $this->errors = $html;
        }
    }

    protected function setHeaderAndFooter()
    {
        $pages = \App\Pages::where('id_company', env('ID_COMPANY'))
                            ->where('id', '>', 0)
                            ->where('active', 1)
                            ->orderBy('order', 'ASC')
                            ->get();
        
        $company = \App\Companies::where("id", env('ID_COMPANY'))->first();
        $skin = \App\Skins::where('id_company', env('ID_COMPANY') )->first();
        $logo = ( is_object( $skin ) && file_exists( $skin->logo ) ) ? $skin->logo : "img/logo_colour.png";
        $this->cont->footer = view('layout/footer', array("logo" => $logo));
        $this->cont->header = view("layout/header", array( "company" => $company, "logo" => $logo ));
    }

    protected function RenderView() {
        $this->setHeaderAndFooter();
        $skin = \App\Skins::where('id_company', env('ID_COMPANY') )->first();
        $resorts = ( is_object( $skin ) ) ? "css/resorts.css?v=$skin->version" : "css/resorts.css";
        $style = ( is_object( $skin ) ) ? "css/style_.css?v=$skin->version" : "css/style_.css";
        
        $safari = false;
        $ua = $_SERVER["HTTP_USER_AGENT"];      // Get user-agent of browser
        $safariorchrome = strpos($ua, 'Safari') ? true : false;     // Browser is either Safari or Chrome (since Chrome User-Agent includes the word 'Safari')
        $chrome = strpos($ua, 'Chrome') ? true : false;             // Browser is Chrome
        if($safariorchrome === true AND $chrome === false){ $safari = true; }
        $_SESSION['errors'] = "";
        $template = "layout/app";
        return view($template, array(
            'bodyClass' => $this->bodyClass,
            'title' => $this->title,
            'errors' => $this->errors,
            'header' => $this->cont->header,
            'footer' => $this->cont->footer,
            'content' => $this->cont->body,
            "iconClass" => $this->iconClass,
            "titulo" => $this->pageTitle,
            "botonera" => $this->botonera,
            "keywords" => $this->keywords,
            "description" => $this->description,
            "safari" => $safari,
            "style" => $style,
            "resorts" => $resorts,
            "set_menu" => $this->set_menu
        ));
    }

    protected function createTable() {
        return view('comun/tabla', array(
            "selectIds" => $this->selectIds,
            'gridId' => $this->gridId,
            'ancho_tabla' => $this->ancho_tabla,
            'altura_tabla' => $this->altura_tabla,
            'campos' => json_encode($this->campos),
            "dataID" => $this->dataID,
            'data' => json_encode($this->data),
            "detailURL" => $this->detailURL,
            'pageSize' => $this->pageSize
        ));
    }

    public function prettifyData( $data )
    {
        return $data;
    }
    
    public function createGrid() {

        $table = view($this->tableTemplate, array(
            'controller' => $this->controller,
            'grid_id' => $this->gridId,
            'columns' => $this->columns,
            'page_size' => $this->page_size,
            'successFunction' => $this->successFunction
        ));

        return $table;
    }

    public function specialGrid($data, $template)
    {

        $grid = view($template, array(
            'data' => $data
        ));

        return $grid;
    }
    
    protected function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        if ( is_dir($dirPath)) {
            rmdir($dirPath);
        }
        
    }
}
