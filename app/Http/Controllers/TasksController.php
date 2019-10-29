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
        $tasks = ( isset( $_REQUEST["id_user"] ) && $_REQUEST["id_user"] != "" ) ? \App\Tasks::getForUser( $_REQUEST["id_user"] ) : \App\Tasks::getForUser( $this->user->id ); 
        $taskHTML = "";
        foreach ( $tasks as $task )
        {
            $taskHTML .= view('tasks/taskcard', array(
                "task" => $task
            ));
        }

        $companies = \App\Companies::orderBy("name", "ASC")->get();
        $types = \App\TaskType::orderBy("description", "ASC")->get();

        $this->pageTitle = "Tasks";
        $this->iconClass = "fa-calendar";
        $this->botonera = view("tasks/btns");
        $this->cont->body = view('tasks/index', array(
            "tasks" => $taskHTML,
            "user" => $this->user,
            "companies" => $companies,
            "types" => $types
        ));
        return $this->RenderView();
    }

    public function getTasksAction()
    {
        $tasks = ( isset( $_REQUEST["id_user"] ) && $_REQUEST["id_user"] != "" ) ? \App\Tasks::getForUser( $_REQUEST["id_user"] ) : \App\Tasks::getForUser( $this->user->id ); 
        $taskHTML = "";
        foreach ( $tasks as $task )
        {
            $taskHTML .= view('tasks/taskcard', array(
                "task" => $task
            ));
        }
        return $taskHTML;
    }

    public function editAction()
    {
        
        $this->pageTitle = $this->translator->get("edit_task");
        $this->iconClass = "fas fa-calendar";
        if ( !isset( $_REQUEST["id"] ) || $_REQUEST["id"] == "" ) return \Redirect::to("Admin")->send();
        $task = \App\Tasks::where("id", $_REQUEST["id"] )->first();
        if ( !is_object( $task ) ) return \Redirect::to("Admin")->send();

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
        $task = \App\Tasks::where( "id", $_REQUEST["id"] )->first();
        $task->update( $_REQUEST );
        \NotificationLogic::editTask( $task );

        return \Redirect::to("Tasks");
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
}