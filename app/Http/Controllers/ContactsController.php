<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class ContactsController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {
        $listado = $this->getListadoAction();
        $this->pageTitle = "Contacts";
        $this->iconClass = "fa-address-book";
        $this->botonera = '<div class="btn btn-primary" onclick="addContact()"><i class="fas fa-plus"></i> Add Contact</div>';
        $this->cont->body = view('contacts/index', array("listado" => $listado ) );
        return $this->RenderView();
    }

    public function addModalAction()
    {
        $types = \App\ContactType::get();
        return view('contacts/add_modal', array("types" => $types ) );
    }

    public function editModalAction()
    {
        $id = $_REQUEST['id'];
        $types = \App\ContactType::get();
        $contact = \App\Contacts::where('id', $id)->first();
        return view('contacts/edit_modal', array( "contact" => $contact, "types" => $types ) );
    }

    public function addContactAction()
    {
        if ( isset( $_REQUEST['id'] ) && $_REQUEST['id'] != "" )
        {
            $contact = \App\Contacts::where('id', $_REQUEST['id'])->first();
            $contact->update( $_REQUEST );

            $status = 1;
        }
        else
        {
            $contact = \App\Contacts::create($_REQUEST);
            $contact->id_user = $this->user->id;
            $contact->save();
            $status = 2;
        }

        $html = view('contacts/card', array(
            "contact" => $contact
        ));
        
        return json_encode(
            array(
                "status" => $status,
                "response" => utf8_encode($html)
            )
        );
    }

    public function messageAction()
    {
        $contact = \App\Contacts::where('id', $_REQUEST['id'])->first();
        return view('contacts/send_modal', array(
            "contact" => $contact
        ));
    }

    public function getListadoAction()
    {
        $html = "";
        $contacts = \App\Contacts::where('id_user', $this->user->id)->get();
        foreach ( $contacts as $contact )
        {
            $html .= view('contacts/card', array(
                "contact" => $contact
            ));
        }

        return view('contacts/list', array(
            "contacts" => $html
        ));
    }

    public function addFromUserAction()
    {
        $msg = "Contact updated successfully";
        $user = \App\User::where('id', $_REQUEST['id'])->first();
        $contact = \App\Contacts::where('id_user', $this->user->id)->where('id_user_contact', $user->id)->first();
        if ( !is_object( $contact ) )
        {

            $contact = new \App\Contacts();
            $msg = "Contact created successfully";
        }
        $contact->id_user = $this->user->id;
        $contact->id_user_contact = $user->id;
        $contact->phone = $user->phone;
        $contact->email = $user->email;
        $contact->name = $user->name;
        $contact->surname = $user->surname;
        $contact->save();

        return json_encode( array(
            "success" => 1,
            "message" => $msg
        ));
    }
}