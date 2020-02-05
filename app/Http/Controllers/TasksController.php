<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class TasksController extends BaseController
{
    public function __construct() {
        $this->secure = 1;
        parent::__construct();
    }
    
    public function defaultAction() {
        if ( !is_object( $this->user ) ) return \Redirect::to("Admin");
        

        $listado = $this->getTasksAction();
        $companies = \App\Companies::orderBy("name", "ASC")->get();
        $types = \App\TaskType::orderBy("description", "ASC")->get();

        $this->pageTitle = "Tasks";
        $this->iconClass = "fa-calendar";
        if ( $this->user->role != "PO" ) $this->botonera = view("tasks/btns");
        $this->cont->body = view('tasks/index', array(
            "tasks" => $listado,
            "user" => $this->user,
            "companies" => $companies,
            "types" => $types
        ));
        return $this->RenderView();
    }

    public function getTasksAction()
    {
        $this->data = \App\Tasks::whereRaw( $this->makeWhere() )->get();
        $this->campos[] = array(
            "title"=> "Title",
            "name" => "title"
        );
        if ( $this->user->role != "PO" )
        {
            $this->decorateRow();
            $this->campos[] = array(
                "title" => "User",
                "name" => "user"
            );
        }
        $this->campos[] = array(
            "title"=> "From",
            "name" => "date_start"
        );
        $this->campos[] = array(
            "title"=> "To",
            "name" => "date_end"
        );
        $this->detailURL = "Tasks.edit?id=";
        if ( count( $this->data ) > 0 ) return $this->createTable();
        return view("comun/nodata");
    }

    protected function decorateRow()
    {
        foreach ( $this->data as $row )
        {
            $user = \App\User::where("id", $row->id_user )->first();
            $row->user = $user->name." ".$user->surname;
        }
    }

    public function makeWhere()
    {
        $where = " 1 ";
        if ( !isset( $_REQUEST["id_user"] ) || $_REQUEST["id_user"] == "")
        {
            if ( $this->user->role == "AA" )
            {
                $where .= " AND id_company = ".$this->user->id_company;
            }
            if ( $this->user->role == "M" )
            {
                $where .= " AND ( id_user = ".$this->user->id." OR id_user IN ( SELECT id_property_owner FROM properties WHERE id_assigned_to = ".$this->user->id." ) ) ";
            }
            if ( $this->user->role == "PO" )
            {
                $where .= " AND ( id_user = ".$this->user->id." OR id_property IN (SELECT id FROM properties WHERE id_property_owner = ".$this->user->id." )  ) ";
            }
        }
        if ( !isset( $_REQUEST["from"] ) ) $where .= " AND ( DATE( date_start )  >= DATE( NOW() ) OR date_start IS NULL ) ";
        if ( isset( $_REQUEST["id_type"] ) && $_REQUEST["id_type"] != "" ) $where .= " AND id_type = ".$_REQUEST["id_type"];
        if ( isset( $_REQUEST["status"] ) && $_REQUEST["status"] != "" ) $where .= " AND status = ".$_REQUEST["status"];
        if ( isset( $_REQUEST["id_company"] ) && $_REQUEST["id_company"] != "" ) $where .= " AND id_company = ".$_REQUEST["id_company"];
        if ( isset( $_REQUEST["id_property"] ) && $_REQUEST["id_property"] != "" ) $where .= " AND id_property = ".$_REQUEST["id_property"];
        if ( isset( $_REQUEST["id_user"] ) && $_REQUEST["id_user"] != "" ) $where .= " AND id_user = ".$_REQUEST["id_user"];
        if ( isset( $_REQUEST["pp"] ) && $_REQUEST["pp"] == "1" ) $where .= " AND date_start < NOW() ";
        if ( isset( $_REQUEST["pp"] ) && $_REQUEST["pp"] == "all" ) $where .= "  ";
        if ( isset( $_REQUEST["from"] ) && $_REQUEST["from"] != "" ) $where .= " AND DATE( date_start ) >= DATE( '".$_REQUEST["from"]."' ) ";
        if ( isset( $_REQUEST["to"] ) && $_REQUEST["to"] != "" ) $where .= " AND DATE( date_start ) <= DATE( '".$_REQUEST["to"]."' ) ";

        $where .= (isset( $_REQUEST["archived"] ) && $_REQUEST["archived"] != "" ) ? "" : " AND ( archived = 0 OR archived IS NULL ) ";

        

        return $where ;
    }

    public function editAction()
    {
        
        $this->pageTitle = $this->translator->get("edit_task");
        $this->iconClass = "fas fa-calendar";
        if ( !isset( $_REQUEST["id"] ) || $_REQUEST["id"] == "" ) return \Redirect::to("Admin")->send();
        $task = \App\Tasks::where("id", $_REQUEST["id"] )->first();
        if ( !is_object( $task ) ) return \Redirect::to("Admin")->send();
        if ( ! \AppConfig::canView("TASK", $task) ) return \Redirect::to("Tasks")->send();
        if ( ! \AppConfig::canEdit("TASK", $task ) ) return $this->cannotEdit();

        $subtasks = $this->getSubTasksAction( $task->id );


        $creator = \App\User::where("id", $task->id_created_by )->first();
        $task->creator = ( is_object ( $creator ) ) ? $creator->name." ".$creator->surname : "N/A";
        
        $creator = \App\User::where("id", $task->id_user )->first();
        $task->assigned_to = ( is_object ( $creator ) ) ? strtoupper($creator->name." ".$creator->surname) : "N/A";

        $types = \App\TaskType::get();
        $files = \App\TasksFiles::where("id_task", $task->id)->get();

        $tw = \App\TasksWatching::where("id_user", $this->user->id)->where("id_task", $task->id)->first();
        $watching = ( is_object( $tw ) ) ? 1 : 0;

        $this->botonera = view("tasks/editbtn", array(
            "url" => "Tasks",
            "watch" => $watching,
            "task" => $task,
            "user" => $this->user
        ));

        $this->cont->body = view("tasks/detail", array(
            "task" => $task,
            "types" => $types,
            "files" => $files,
            "subtasks" => $subtasks
        ));

        return $this->RenderView();

    }

    public function deleteSubtaskAction()
    {
        $id = $_REQUEST["id"];
        $subTask = \App\Subtasks::where("id", $id)->first();
        $subTask->delete();
        return json_encode(
            array(
                "success" => 1
            )
        );
    }
    public function updateSubtaskAction()
    {
        $id = $_REQUEST["id"];
        $title = $_REQUEST["name"];
        $subTask = \App\Subtasks::where("id", $id)->first();
        $subTask->title = $title;
        $subTask->save();

        return "OK";
    }

    public function changeSubtaskStatusAction()
    {
        $date = new \DateTime();
        $id = $_REQUEST["id"];
        $subtask = \App\Subtasks::where("id", $id)->first();
        if ( (int)$subtask->completed === 1 )
        {
            $subtask->date_completed = NULL;
            $subtask->completed = 0;
            $subtask->completed_by = NULL;
            $subtask->save();
        }
        else
        {
            $subtask->completed = 1;
            $subtask->date_completed = $date->format("Y-m-d H:i:s");
            $subtask->completed_by = $this->user->id;
            $subtask->save();
        }

        return json_encode(
            array(
                "success" => 1,
                "completed" => $subtask->completed
            )
        );
    }

    public function updateSubtaskOrderAction()
    {
        $id_page = $_REQUEST["id"];
        $ids = $_REQUEST['ids'];
        $id_array = explode('@#', $ids, -1);
        $i = 1;
        foreach ( $id_array as $id )
        {
            $section = \App\Subtasks::where('id', $id)->first();
            $section->updateOrder( $i );
            $i++;
        }
        return "OK";
    }

    public function newSubtaskAction()
    {
        $subTask = \App\Subtasks::create();
        $subTask->id_task = $_REQUEST["id_task"];
        $subTask->save();
        $subTask->updateOrder();
        return view("tasks/subtask", array(
            "subtask" => $subTask
        ));
    }

    public function getSubtasksAction( $id = null )
    {
        if ( is_null( $id ) ) $id = $_REQUEST["id"];
        $subtasks = \App\Subtasks::where("id_task", $id)->orderBy("order", "ASC")->get();
        $html = "";


        foreach ( $subtasks as $st )
        {
            $html .= view("tasks/subtask", array(
                "subtask" => $st
            ));
        }

        return $html;
    }


    public function cannotEdit()
    {
        $task = \App\Tasks::where("id", $_REQUEST["id"] )->first();
        $creator = \App\User::where("id", $task->id_created_by )->first();
        $task->creator = ( is_object ( $creator ) ) ? $creator->name." ".$creator->surname : "N/A";
        
        $creator = \App\User::where("id", $task->id_user )->first();
        $task->assigned_to = ( is_object ( $creator ) ) ? strtoupper($creator->name." ".$creator->surname) : "N/A";

        $types = \App\TaskType::get();
        $files = \App\TasksFiles::where("id_task", $task->id)->get();

        $tw = \App\TasksWatching::where("id_user", $this->user->id)->where("id_task", $task->id)->first();
        $watching = ( is_object( $tw ) ) ? 1 : 0;

        $this->cont->body = view("tasks/detail_cannotedit", array(
            "task" => $task,
            "types" => $types,
            "files" => $files
        ));

        return $this->RenderView();
    }

    public function toggleWatchingAction()
    {
        $id = $_REQUEST["id"];
        
        $tw = \App\TasksWatching::where("id_user", $this->user->id)->where("id_task", $id)->first();
        if ( !is_object( $tw ) )
        {
            $tw = new \App\TasksWatching();
            $tw->id_user = $this->user->id;
            $tw->id_task = $id;
            $tw->save();
            return 1;          
        }
        else
        {
            $tw->delete();
            return 0;
        }
    }

    public function uploadFileAction()
    {
        $id = $_REQUEST["id"];
        $tempFile = $_FILES['file']['tmp_name'];
        $targetDir = "data/tasks/$id";
        if ( !is_dir( $targetDir ) ) mkdir( $targetDir, 0777, true );
        $file = new \App\TasksFiles();
        $file->route = $_FILES['file']['name'];
        $file->id_task = $id;
        $file->save();
     
        $targetFile =  $targetDir. "/".$_FILES['file']['name'];  //5
        \move_uploaded_file($tempFile,$targetFile); //6
        die($targetFile);
    }

    public function deleteFileAction()
    {
        $id = $_REQUEST["id"];
        $file = \App\TasksFiles::where("id", $id)->first();
        if  (file_exists( "data/tasks/$file->id_task/$file->route" ) ) \unlink("data/tasks/$file->id_task/$file->route");
        $file->delete();
        return "OK";
    }

    public function addAction()
    {
        $date = new \DateTime();
        $task = \App\Tasks::create( $_REQUEST );
        $task->id_created_by = $_SESSION['id'];
        $task->created_on = $date->format('Y-m-d H:i:s');
        $task->status = 1;
        $task->save();
        
        \NotificationLogic::newTask( $task );

        if ( isset ( $_SERVER["HTTP_REFERER"] ) ) return \Redirect::to( $_SERVER["HTTP_REFERER"] );
        return \Redirect::to("Admin"); 
    }

    public function updateAction()
    {
        $date = new \DateTime();
        $task = \App\Tasks::where( "id", $_REQUEST["id"] )->first();
        if ( (int)$task->status !== 3 && (int)$_REQUEST["status"] === 3 ) $task->completed = $date->format("Y-m-d H:i:s");
        $task->save();
        $task->update( $_REQUEST );
        
        \NotificationLogic::editTask( $task );

        return \Redirect::to("Tasks");
    }

    public function archiveAction()
    {
        $task = \App\Tasks::where( "id", $_REQUEST["id"] )->first();
        $task->archived = (int)$_REQUEST["archive"];
        $task->save();
        $message = ( $task->archive === 1 ) ? "Task archived successfully" : "Task restored successfully";
        return json_encode(
            array(
                "success" => 1,
                "message" => $message
            )
        );
    }

    public function addModalAction()
    {
        $types = \App\TaskType::get();
        return view('modal/addtask', array(
            "types" => $types
        ));
    }

    public function toggleStatusAction()
    {
        $id = $_REQUEST['id'];
        $task = \App\Tasks::where('id', $id)->first();
        $task->status = ( (int)$task->status === 1 ) ? 3 : 1;
        $task->save();
        \NotificationLogic::updateStatusTask( $task );
        return "OK";
    }

    public function deleteTaskAction()
    {
        $id = $_REQUEST['id'];
        $task = \App\Tasks::where('id', $id)->first();
        $task->delete();
        $media = \App\TasksFiles::where("id_task", $id)->get();
        foreach ( $media as  $row )
        {
            if ( \file_exists( $media->route ) ) \unlink($media->route);
            $media->delete();
        }
        return "OK";
    }


    public function getPropertyCalendarAction()
    {
        $id = $_REQUEST["id"];
        $property = \App\Properties::where("id", $id)->first();
        return json_encode( \App\Tasks::getPropertyCalendar( $property ) );
    }

    public function getPropertyOwnerCalendarAction()
    {
        return json_encode( \App\Tasks::getPropertyOwnerCalendar() );
    }

    public function getUserCalendarAction()
    {
        return json_encode( \App\Tasks::getMyCalendar() );        
    }

}