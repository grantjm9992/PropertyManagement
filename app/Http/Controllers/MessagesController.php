<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class MessagesController extends BaseController
{
    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        $this->pageTitle = "Messages";
        $this->iconClass = "fa-envelope";
        $this->cont->body = view('messages/index', array(
            "conversations" => $this->conversationsAction()
        ));
        return $this->RenderView();
    }

    public function conversationsAction()
    {
        $html = "";
        $conversations = \App\ConversationsUsers::where('id_user', $this->user->id )->orderBy('last_message', 'DESC')->get();
        foreach ( $conversations as $row )
        {
            $conversation = \App\Conversations::where('id', $row->id_conversation)->first();
            $conversation->getForCard();
            $html .= view('messages/message_card', array(
                "message" => $conversation
            ));
        }

        return $html;
    }
}