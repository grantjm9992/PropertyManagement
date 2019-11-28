<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

use \App\User;

class LoginController extends Controller
{
    public function defaultAction()
    {
        return view('login/index');
    }    

    public function checkUserAction()
    {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $user = User::where('user', $username)->where('password', md5($password) )->first();
        if ( !is_object( $user ) )
        {
            $_SESSION['errors'] = "Username or Password incorrect@#";
            \Redirect::to('Login')->send();
        }
        $date = new \DateTime();
        $user->last_seen = $date->format("Y-m-d H:i:s");
        $_SESSION['id'] = $user->id;
        \Redirect::to('Admin')->send();
    }

    public function logoutAction()
    {
        session_destroy();
        \Redirect::to('Login')->send();
    }
}
