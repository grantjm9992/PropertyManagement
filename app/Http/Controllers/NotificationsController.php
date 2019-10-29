<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class NotificationsController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        $ntfs = \App\Notifications::getUnseenForUser();
        $notifications = "";
        $seen = "";
        foreach ( $ntfs as $row )
        {
            $notifications .= view("notifications/notificationcard", array(
                "notification" => $row
            ));
        }

        $olds = \App\Notifications::where("id_user", $this->user->id)->where("is_seen", 1)->get();

        foreach ( $olds as $row )
        {
            $seen .= view("notifications/notificationcard", array(
                "notification" => $row,
                "class" => "bg-light"
            ));
        }
        $this->pageTitle = "Notifications";
        $this->iconClass = "fa-star";
        $this->cont->body = view('notifications/index', array(
            "user" => $this->user,
            "notifications" => $notifications,
            "seen" => $seen
        ));
        return $this->RenderView();
    }

    public function seenAction()
    {
        $id = $_REQUEST["id"];
        $notification = \App\Notifications::where("id", $id)->first();
        $notification->is_seen = 1;
        $notification->save();
        return "OK";
    }
}