<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class MyProfileController extends BaseController
{
    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser( $this->user->id );
    }
    
    public function defaultAction() {
        $this->botonera = '<div class="btn btn-primary" onclick="submitForm()"><i class="fas fa-save"></i> Save</div>';
        $widgets = \App\Widgets::get();
        $widgetsUser = \App\WidgetsUser::where( 'id_user', $this->user->id )->orderBy('order', 'ASC')->get();
        $idArray = array();
        $html = "";
        foreach ( $widgetsUser as $row ) 
        {
            $widget = \App\Widgets::where('id', $row->id_widget)->first();
            $idArray[] = $row->id_widget;
            $html .= view('admin/profile/widgetrow', array(
                "widget" => $widget
            ));
        }
        $widgetArray = array();
        foreach ( $widgets as $row )
        {
            if ( !in_array( $row->id, $idArray ) )
            {
                $widgetArray[] = $row;
            }
        }
        $this->pageTitle = "My Profile";
        $this->iconClass = "fa-user";
        $this->cont->body = view('admin/profile/index', array(
            "user" => $this->user,
            "widgets" => $html,
            "widgets_select" => $widgetArray
        ));
        return $this->RenderView();
    }

    public function addWidgetAction()
    {
        $id = $_REQUEST['id'];
        $widget = \App\Widgets::where('id', $id)->first();
        $wu = \App\WidgetsUser::create();
        $wu->id_widget = $id;
        $wu->id_user = $this->user->id;
        $wu->save();
        return view('admin/profile/widgetrow', array(
            "widget" => $widget
        ));
    }

    public function saveAction() {
        
        $user = $this->user;
        $user->update( $_REQUEST );
        if ( isset( $_REQUEST["password"] ) && $_REQUEST["password"] != "" ) $user->password = md5($_REQUEST["password"]);
        $user->save();
        return \Redirect::to('MyProfile')->send();
    }

    public function updateWidgetOrderAction()
    {
        $ids = $_REQUEST['ids'];
        $id_array = explode('@#', $ids, -1);
        $id_user = $_REQUEST['id'];
        $i = 1;
        foreach ( $id_array as $id )
        {
            $WidgetUser = \App\WidgetsUser::where('id_widget', $id)->where('id_user', $id_user)->first();
            $WidgetUser->updateOrder( $i );
            $i++;
        }
        return "OK";
    }

    public function updateDashboardAction()
    {
        $leftIds = $_REQUEST["leftIds"];
        $rightIds = $_REQUEST["rightIds"];

        $leftIdArray = explode("@#", $leftIds, -1);
        $rightIdArray = explode("@#", $rightIds, -1);

        $appConfig = \App\AppConfig::where("id_user", $this->user->id)->first();

        if ( is_object( $appConfig ) )
        {        

            $config = json_decode($appConfig->config);
            $config->dashboard->left = $leftIdArray;
            $config->dashboard->right = $rightIdArray;
    
        }
        else
        {
            $appConfig = new \App\AppConfig();
            $appConfig->id_user = $this->user->id;
            $config = array(
                "dashboard" => array(
                    "left" => $leftIdArray,
                    "right" => $rightIdArray
                )
            );
        }

        $appConfig->config = json_encode($config);
        $appConfig->save();

        return "OK";
    }
}


/**
 * 
 * THINGS TO INCLUDE
 * 
 *      CHANGE PERSONAL DATA
 *      CHANGE WIDGETS
 *      EXPORT PERSONAL REPORTS (ANALYTICS MAYBE) * 
 * 
 */