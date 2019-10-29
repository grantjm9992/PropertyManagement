<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class PropertyCalendarController extends BaseController
{
    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        $this->pageTitle = "Dashboard";
        $this->iconClass = "fa-tachometer-alt";
        
        if ( !isset ( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return \Redirect::to('AdminProperties')->send();

        $property = \App\Properties::where('id', $_REQUEST['id'])->first();
        
        if ( !is_object( $property ) )  return \Redirect::to('AdminProperties')->send();

        $calendar = $this->getCalendarAction( $property );

        $this->cont->body = view('admin/calendar/index', array(
            "property" => $property,
            "calendar" => view('comun/schedule', array( "property" => $property ) )
        ));
        return $this->RenderView();
    }

    public function getCalendarAction( $property = null )
    {
        if ( $property === null)
        {
            if ( !isset ( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) return \Redirect::to('AdminProperties')->send();
            $property = \App\Properties::where('id', $_REQUEST['id'])->first();
        }

        $rentals = \App\Rentals::getCalendar( $property->id );

        return json_encode( $rentals );
        
    }
}