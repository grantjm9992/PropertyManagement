<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class ReservationsController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        if ( isset( $_REQUEST["id_property"] ) ) return $this->forPropertyAction();
    }

    public function detailAction()
    {
        if ( !isset( $_REQUEST['id'] ) || $_REQUEST['id'] == "" ) \Redirect::to("Properties")->send();
        $id = $_REQUEST["id"];
        $rental = \App\Rentals::where("id", $id)->first();

        $this->pageTitle = "Edit reservation";
        $this->iconClass = "fas fa-calendar";
        $this->botonera = view("admin/reservations/btns", array(
            "url" => "PropertyCalendar?id=$rental->id_property"
        ));

        $this->returnURL = "PropertyCalendar?id=$rental->id_property";

        $this->cont->body = view("admin/reservations/detail", array(
            "data" => $rental,
            "specialurl" => $this->createURL( $rental, true )
        ));

        return $this->RenderView();
    }

    public function forPropertyAction()
    {
        $property = \App\Properties::where('id', $_REQUEST['id_property'])->first();        
        if ( !is_object( $property ) )  return \Redirect::to('AdminProperties')->send();
        
        $this->botonera = view("admin/calendar/addbtn", array(
            "property" => $property
        ));

        $this->cont->body = view('admin/calendar/index', array(
            "property" => $property,
            "calendar" => view('comun/schedule', array( "property" => $property, "rentals" => $this->getCalendarAction() ) ),
            
        ));
        
        $this->pageTitle = "Reservations for: $property->title";
        $this->iconClass = "fas fa-calendar";
        $this->returnURL = "AdminProperties.detail?id=$property->id";

        return $this->RenderView();

    }

    public function updateAction()
    {
        $id = $_REQUEST["id"];
        $reservation = \App\Rentals::where("id", $id)->first();
        $reservation->update( $_REQUEST );
        $reservation->save();

        return \Redirect::to("Reservations?id_property=$reservation->id_property")->send();
    }

    public function getCalendarAction( $property = null )
    {
        if ( $property === null)
        {
            if ( !isset ( $_REQUEST['id_property'] ) || $_REQUEST['id_property'] == "" ) return \Redirect::to('AdminProperties')->send();
            $property = \App\Properties::where('id', $_REQUEST['id_property'])->first();
        }

        $rentals = \App\Rentals::getCalendar( $property->id );
        return  $rentals;
        
    }

    
    public function getUnavailableDatesAction()
    {
        if ( !isset( $_REQUEST['id_property'] ) || $_REQUEST['id_property'] == "" ) return \Redirect::to("Properties")->send();
        $id = $_REQUEST["id_property"];
        $reservations = \App\Rentals::where("id_property", $id)->get();
        $res = array();
        foreach ( $reservations as $row )
        {
            $start = new \DateTime( $row->date_start );
            $end = new \DateTime( $row->date_end );
            $start->setTime("12", "00");
            $end->setTime("12", "00");
            while ( $start < $end )
            {
                $res[] = $start->format("Y-m-d");
                $start->modify("+1 days");
            }
        }

        return json_encode($res);
    }

    public function addAction()
    {
        $id_property = $_REQUEST["id_property"];
        $rental = \App\Rentals::create( $_REQUEST );
        return \Redirect::to("Reservations.detail?id=$rental->id")->send();
    }

    public function getUntiWhenAction()
    {
        $id = $_REQUEST["id_property"];
        $day = $_REQUEST["date"];
        $day = new \DateTime( $day );
        $day = $day->format("Y-m-d");
        $reservation = \App\Rentals::where("id_property", $id)->whereDate("date_start", ">", $day)->first();
        if ( is_object( $reservation ) )
        {
            $until = new \DateTime( $reservation->date_start );
        }
        else
        {
            $until = new \DateTime("2999-12-12");
        }

        return $until->format("Y-m-d");
    }

    public function addModalAction()
    {
        $id_property = $_REQUEST["id_property"];
        $id_type = ( isset( $_REQUEST["id_type"] ) ) ? $_REQUEST["id_type"] : "";
        return view("modal/addrental", array(
            "id_property" => $id_property,
            "id_type" => $id_type,
            "unavailable_dates" => $this->getUnavailableDatesAction()
        ));
    }

    
    protected function createURL( $reservation, $paid = false )
    {
        $base = url("/");

        $string = "id=".base64_encode( $reservation->id_property );
        if( $paid ) $string .= "&conf=1&id_reserva=".base64_encode( $reservation->id );

        $string = "?p=".base64_encode( $string );
        return "$base/$string";
    }

    public function deleteAction()
    {
        $id = $_REQUEST["id_reservation"];
        $reservation = \App\Rentals::where("id", $id)->first();
        $tasks = \App\Tasks::where("id_reservation", $id)->get();
        foreach ( $tasks as $task )
        {
            $task = \App\Tasks::where("id", $task->id)->first();
            $task->delete();
        }

        $reservation->delete();

        die( "OK" );
    }
}