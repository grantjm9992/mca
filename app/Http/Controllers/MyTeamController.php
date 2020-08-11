<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class MyTeamController extends BaseController
{

    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }
    
    public function defaultAction() {

        $this->pageTitle = "My team";
        $this->iconClass = "fas fa-users";

        $bg = [
            "bg-info",
            "bg-success",
            "bg-primary",
            "bg-secondary",
            "bg-warning"
        ];
        
        $myTeam = \App\User::where("id_company", $this->user->id_company)->where("role", "!=", "PO")->get();
        
        $myTeamHTML = "";
        $i = 0;
        foreach ($myTeam as $user) {
            $pending = \App\Tasks::where("id_user", $user->id)->where("status", "!=", 3)->get();
            $completed = \App\Tasks::where("id_user", $user->id)->where("status", 3)->get();
            $properties = \App\Properties::where("id_assigned_to", $user->id)->get();
            $user->pending = count($pending);
            $user->completed = count($completed);
            $user->properties = count($properties);
            $user->image = ( file_exists( $user->image ) ) ? $user->image : "img/user.png";
            $user->bg = $bg[$i%5];
            $myTeamHTML .= view("admin/myteam/usercard", array(
                "user" => $user
            ));
            $i++;
        }
        
        $this->cont->body = view("admin/myteam/index", array(
            "myTeamHTML" => $myTeamHTML
        ));
        return $this->RenderView();
    }
    
    public function userTimelineAction() {
        $id_user = $_REQUEST["id_user"];
        $user = \App\User::where("id", $id_user)->first();
        $logs = \App\Log::select("log.*", "users.id_company")
                ->join("users", "log.id_user", "=", "users.id")
                ->where("users.id", $id_user)
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
        if ($html == "") $html = "<div class='alert alert-warning'>No activty reported for $user->name $user->surname</div>";
        $this->cont->body = view("admin/myteam/usertimeline", array(
            "events" => $html,
            "user" => $user
        ));

        return $this->RenderView();
    }

    public function userTasksAction() {
        $id_user = \base64_decode($_REQUEST["id_user"]);
    }
    
}