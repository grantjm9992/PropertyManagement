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
    protected $set_menu;

    public function __construct() {
        parent::__construct();
        $this->cont = new \ArrayObject();
        $this->campos = array();
        $this->title = "The Resorts";
        $this->keywords = "";
        $this->selectIds = "@#";
        $this->description = "The Resorts";
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
        $this->setHeaderAndFooter();

        
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
        $this->cont->footer = view('layout/footer');
        $this->cont->header = view('layout/header', array( "properties" => "" ));
    }

    protected function RenderView() {
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
            "description" => $this->description
        ));
    }

    protected function getErrors() {
        $errors = "";
        if ( isset($_SESSION['errors']) && $_SESSION['errors'] != "" )
        {
            $errors = "<ul>";
            $error_array = explode('@#', $_SESSION['errors'], -1);
            foreach ( $error_array as $error )
            {
                $errors .= "<li>".$error."</li>";
            }
            $errors .= "</ul>";
        }
        $_SESSION['errors'] = "";
        return $errors;
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
