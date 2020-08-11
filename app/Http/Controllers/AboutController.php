<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class AboutController extends BaseController
{

    public function __construct() {
        
        parent::__construct();
    }
    
    public function defaultAction() {
        $company = \App\Companies::where("id", env("ID_COMPANY") )->first();
        
        $this->cont->body = view("about/index", array(
            "contact" => view("presets/contactSection", array(
                "company" => $company
            ))
        ));
        return $this->RenderView();
    }

}