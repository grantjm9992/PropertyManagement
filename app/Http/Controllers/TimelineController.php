<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class TimelineController extends BaseController
{

    public function __construct() {
        parent::__construct();
    }
    
    public function defaultAction() {
        $logs = \App\Log::select("log.*", "users.id_company")
                ->join("users", "log.id_user", "=", "users.id")
                ->where("users.id_company", $this->user->id_company)
                ->orderBy("date", "DESC")
                ->take(20)
                ->get();
        $html = "";
        $last_date = new \DateTime("0000-00-00 00:00:00");
        foreach ( $logs as $log )
        {
            $date = new \DateTime( $log->date );
            if ($date->format("d/m/Y") != $last_date->format("d/m/Y") )
            {
                $last_date = $date;
                $html .= view("timeline/date", array(
                    "date" => $last_date->format("d/m/Y")
                ));
            }

            $log->date = \AppConfig::makeTimelineTime( $log->date );
            $html .= view("timeline/event", array(
                "event" => $log
            ));
        }
        $this->cont->body = view("timeline/index", array(
            "events" => $html
        ));

        return $this->RenderView();
    }
}