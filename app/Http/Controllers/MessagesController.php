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
        $convo = ( isset( $_REQUEST["id"] ) && $_REQUEST["id"] != "" ) ? $this->getConversationAction() : "";
        $this->pageTitle = "Messages";
        $this->iconClass = "fa-envelope";
        $this->cont->body = view('messages/index', array(
            "conversations" => $this->conversationsAction(),
            "conversation" => $convo
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
                "message" => $conversation,
                "user" => $this->user
            ));
        }

        return $html;
    }

    public function newModalAction()
    {
        return view("modal/addmessage");
    }

    public function addFromConversationAction()
    {
        $date = new \DateTime();
        $id_conversation = $_REQUEST["id_conversation"];
        $msg = $_REQUEST["message"];
        $message = new \App\Messages();
        $cu = \App\ConversationsUsers::where("id_conversation", $id_conversation)->get();
        foreach ( $cu as $row )
        {
            $row->last_message = $date->format("Y-m-d H:i:s");
            $row->save();
        }
        $message->message = $msg;
        $message->id_sender = $this->user->id;
        $message->id_conversation = $id_conversation;
        $message->date_sent = $date->format("Y-m-d H:i:s");
        $message->save();
        $html = view("messages/conversation_row", array(
            "sender" => $this->user,
            "message" => $message,
            "user" => $this->user
        ));
        die($html);
        
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

        $date = new \DateTime();
        if ( $exists )
        {
            $id_conversation = $conversationWithUser->id_conversation;
            $message = new \App\Messages();
            $message->id_conversation = $conversationWithUser->id_conversation;
            $message->id_sender = $this->user->id;
            $message->message = $msg;
            $message->date_sent = $date->format("Y-m-d H:i:s");
            $message->save();
        }

        else
        {
            $conversation = new \App\Conversations();
            $conversation->save();
            $id_conversation = $conversation->id;
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
            $message->date_sent = $date->format("Y-m-d H:i:s");
            $message->message = $msg;
            $message->save();
        }

        $cu = \App\ConversationsUsers::where("id_conversation", $id_conversation)->get();
        foreach ( $cu as $row )
        {
            $row->last_message = $date->format("Y-m-d H:i:s");
            $row->save();
        }

        if ( isset( $_REQUEST["modal"] ) && $_REQUEST["modal"] == "1" ) die("OK");
        \Redirect::to("Messages")->send();

    }


    public function getConversationAction()
    {
        $id = $_REQUEST["id"];
        $conversation = \App\Conversations::where("id", $id)->first();
        $messages = \App\Messages::where("id_conversation", $id)->orderBy("date_sent", "ASC")->get();
        $html = "";
        foreach ( $messages as $message )
        {
            if ( (int)$this->user->id !== (int)$message->id_sender )
            {
                $message->is_read = 1;
                $message->save();
            }
            $sender = \App\User::where("id", $message->id_sender)->first();
            $html .= view("messages/conversation_row", array(
                "sender" => $sender,
                "message" => $message,
                "user" => $this->user
            ));
        }

        return view("messages/conversation", array(
            "conversation" => $conversation,
            "html" => $html
        ));
    }

}