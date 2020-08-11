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

        $user = User::where('user', $username)
                ->where("id_company", env("ID_COMPANY"))
                ->where('password', md5($password) )
                ->first();
        if ( !is_object( $user ) )
        {
            $_SESSION['errors'] = "Username or Password incorrect@#";
            \Redirect::to('Login')->send();
        }
        $date = new \DateTime();
        $user->last_seen = $date->format("Y-m-d H:i:s");
        $user->save();
        $_SESSION['id'] = $user->id;
        \Redirect::to('Admin')->send();
    }

    public function logoutAction()
    {
        session_destroy();
        \Redirect::to('Login')->send();
    }

    public function forgotAction() {
        return view("login/forgotpassword");
    }

    public function forgotPasswordAction() {
        $email = $_REQUEST["email"];
        $user = \App\User::where("email", $email)->first();

        if (is_object($user)) {
            $user->access_token = uniqid();
            $user->save();

            $link = url("Login.reset?t=".\base64_encode($user->access_token));

            \Mail::to($email)->send( new \App\Mail\forgotPassword( $user, $link ) );
        }

        return \Redirect::to("Login")->send();
    }

    public function resetAction() {
        if (!isset($_REQUEST["t"])) return \Redirect::to("Login")->send();
        $coded = $_REQUEST["t"];
        $user = \App\User::where("access_token", base64_decode($coded))->first();
        if (!is_object($user)) return \Redirect::to("Login")->send();
        
        return view("login/reset", array(
            "user" => $user
        ));
    }

    public function resetPasswordAction() {
        $accessToken = $_REQUEST["access_token"];
        $password = $_REQUEST["password"];

        $user = \App\User::where("access_token", $accessToken)->first();
        if (!is_object($user)) return \Redirect::to("Login")->send();
        $user->password = md5($password);
        $user->save();

        return \Redirect::to("Login")->send();
    }
}
