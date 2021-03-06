<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class OnSiteController extends BaseController
{

    public function __construct() {
        
        parent::__construct();
    }
    
    public function defaultAction() {
        
        $testimonials = \App\Classes\PresetSectionProvider::testimonialSlider();
        $contactSection = \App\Classes\PresetSectionProvider::contactSection();
        $this->cont->body = view("onsite/index", array(
            "testimonials" => $testimonials,
            "contact" => $contactSection
        ));
        return $this->RenderView();
    }

}