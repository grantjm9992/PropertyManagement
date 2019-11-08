<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class TaskCategoriesController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    

    public function defaultAction() {
        $this->data = \App\TaskType::get();
        $this->campos[] = array(
            "name" => "description",
            "title" => "Description"
        );
        $this->detailURL = "TaskCategories.detail?id=";
        $this->pageTitle = "Task categories";
        $this->iconClass = "fas fa-th-large";
        $this->botonera = view("taskcategories/new");
        $listado = $this->createTable();
        $this->cont->body = view("taskcategories/index", array(
            "listado" => $listado
        ));
        return $this->RenderView();
    }


    public function newAction()
    {
        $category = new \App\TaskType();
        $this->pageTitle = "New category";
        $this->iconClass = "fas fa-th-large";
        $this->botonera = view("taskcategories/editbtns");
        $this->cont->body = view("taskcategories/detail", array(
            "category" => $category
        ));

        return $this->renderView();
    }

    public function detailAction()
    {
        $id =  $_REQUEST["id"];
        $category = \App\TaskType::where("id", $id)->first();
        $this->pageTitle = "New category";
        $this->iconClass = "fas fa-th-large";
        $this->botonera = view("taskcategories/editbtns");
        $this->cont->body = view("taskcategories/detail", array(
            "category" => $category
        ));

        return $this->renderView();
    }

    public function saveAction()
    {
        if ( isset( $_REQUEST["id"] ) && $_REQUEST["id"] != "" )
        {
            $cat = \App\TaskType::where("id", $_REQUEST["id"])->first();
            $cat->update ( $_REQUEST );
        }
        else
        {
            $cat = \App\TaskType::create( $_REQUEST );
        }

        return \Redirect::to("TaskCategories")->send();
    }
}