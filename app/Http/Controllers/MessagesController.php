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

    public function newModalAction()
    {
        return view("modal/addmessage");
    }

    public function addAction()
    {
        $id_user = $_REQUEST['id_user'];
        $msg = $_REQUEST["message"];
        
        $conversations = \App\ConversationsUsers::where("id_user", $this->user->id )->get();
        $ids = array();
        foreach ( $conversations as $row )
        {
            $ids[] = $row->id_conversation;
        }
        $exists = false;
        if ( count( $ids ) > 0 )
        {
            $id_string = implode("", $ids);
            $conversationWithUser = \App\ConversationsUsers::whereRaw("id_conversation in ($id_string) AND id_user = $id_user " )->first();
            if ( is_object( $conversationWithUser ) ) $exists = true;
        }

        if ( $exists )
        {
            $message = new \App\Messages();
            $message->id_conversation = $conversationWithUser->id_conversation;
            $message->id_sender = $this->user->id;
            $message->message = $msg;
            $message->save();
        }

        else
        {
            $conversation = new \App\Conversations();
            $conversation->save();
            $sender = new \App\ConversationsUsers();
            $sender->id_conversation = $conversation->id;
            $sender->id_user = $this->user->id;
            $sender->save();
            $reciever = new \App\ConversationsUsers();
            $reciever->id_conversation = $conversation->id;
            $reciever->id_user = $id_user;
            $reciever->save();
            $message = new \App\Messages();
            $message->id_conversation = $conversation->id;
            $message->id_sender = $this->user->id;
            $message->message = $msg;
            $message->save();
        }

        \Redirect::to("Messages")->send();

    }

}