<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AdminPropertyFeaturesController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
    }
    

    public function defaultAction() {
        $this->pageTitle = "Property Features";
        $this->iconClass = "fa-hotel";

        $features = \App\Features::orderBy("order", "ASC")->get();
        $featureHTML = "";
        foreach ( $features as $row ) {
            $featureHTML .= view("admin/features/feature", array(
                "feature" => $row
            ));
        }

        $this->cont->body = view('admin/features/index', array(
            "featureHTML" => $featureHTML
        ));
        return $this->RenderView();
    }
    

    public function updateOrderAction()
    {
        $ids = $_REQUEST['ids'];
        $id_array = explode('@#', $ids, -1);
        $i = 1;
        foreach ( $id_array as $id )
        {
            $feature = \App\Features::where("id", $id)->first();
            $feature->order = $i;
            $feature->save();
            $i++;
        }
        return "OK";
    }

    public function updateAction()
    {
        $id = $_REQUEST['id'];
        $feature = \App\Features::where('id', $id)->first();
        $feature->title = $_REQUEST['title'];
        $feature->icon = $_REQUEST['icon'];
        $feature->save();
        return "OK";
    }

    public function newAction()
    {
        $section = \App\Features::create($_REQUEST);
        $section->save();
        $section->updateOrder();
        return view('admin/features/feature', array(
            "feature" => $section
        ));
    }

    public function deleteAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return "OK";
        $section = \App\Features::where('id', $_REQUEST['id'])->first();
        $section->delete();
        return "OK";
    }
}