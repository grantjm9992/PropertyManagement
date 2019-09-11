<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;


class HomeController extends BaseController
{

    const ADMIN = array(
        "phisoluciones.es@gmail.com"
    );

    public function __construct() {
        parent::__construct();
        $this->bodyClass = "body";
    }
    
    public function defaultAction() {
        
        $this->cont->body = view('home/index', 
            array(
        ));
        return $this->RenderView();
    }

    public function registerInterestAction()
    {
        $date = new \DateTime();
        $enq = \App\Enquiries::create( $_REQUEST );
        $enq->date_joined = $date->format('Y-m-d H:i:s');
        $enq->save();
    
        $apt = ( isset( $_REQUEST['id_apartment'] ) && $_REQUEST['id_apartment'] != "" ) ? \App\Apartments::where('id', $_REQUEST['id_apartment'])->first() : null;

        $template = view('mail/enquiries', array(
            "enq" => $enq,
            "apt" => $apt
        ));
        
        //\Mail::to ( self::ADMIN )->send( new \App\Mail\Enquiry( $enq, $apt ) );
        
        return "OK";
    }

    public function registerModalAction()
    {
        return view('modal/register');
    }

    public function registerAction()
    {
        $date = new \DateTime();
        $enq = \App\Enquiries::create( $_REQUEST );
        $enq->date_joined = $date->format('Y-m-d H:i:s');
        $enq->save();
    
        $apt = ( isset( $_REQUEST['id_apartment'] ) && $_REQUEST['id_apartment'] != "" ) ? \App\Apartments::where('id', $_REQUEST['id_apartment'])->first() : null;

        $template = view('mail/enquiries', array(
            "enq" => $enq,
            "apt" => $apt
        ));
        
        \Mail::to ( self::ADMIN )->send( new \App\Mail\Enquiry( $enq, $apt ) );
        return \Redirect::to('/')->send();
    }

    protected function panelForCategory( $cat, $class )
    {
        $items = MenuItems::where('id_category', $cat->id)->orderBy('order', 'ASC')->get();
        $left = "";
        $right = "";
        $i = 0;
        foreach ( $items as $row )
        {
            if ( !file_exists( $row->image ) ) $row->image = "images/nophoto.png";
            if ( $i % 2 )
            {
                $right .= view('home/item', array(
                    "item" => $row
                ));
            }
            else
            {
                $left .= view('home/item', array(
                    "item" => $row
                ));
            }
            $i++;
        }

        return view('home/panel', array(
            "left" => $left,
            "right" => $right,
            "active" => $class,
            "cat" => $cat
        ));
    }

    public function acceptCookiesAction()
    {
        setcookie("the_resorts_92", "1");
    }

    public function changeLanguageAction()
    {
        if ( isset( $_REQUEST['locale'] ) && $_REQUEST['locale'] != "" )
        {
            TranslationProvider::_setLocale( $_REQUEST["locale"] );
        }
        return "OK";
    }
}