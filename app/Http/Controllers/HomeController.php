<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;


class HomeController extends BaseController
{

    const ADMIN = array(
        "phisoluciones.es@gmail.com"
    );

    public function __construct() {
        $this->headerClass = "";
        parent::__construct();
        $this->bodyClass = "body";
    }
    
    public function defaultAction() {
        switch (env("THEME")) {
            case "theme_one":
                $this->makeThemeOne();
            break;
            case "theme_two":
                $this->makeThemeTwo();
            break;
            default:
                $this->makeThemeOne();

        }
        return $this->RenderView();
    }

    /**
     * Set up homepage for theme one.
     */
    protected function makeThemeOne()
    {
        $featuredProperties = \App\Classes\PresetSectionProvider::propertyGrid();        
        $blogs = \App\Blogs::take(5)->where("id_company", env("ID_COMPANY"))->orderBy("updated_at", "DESC")->get();
        $this->cont->body = view("home/index", array(
            "blogs" => $blogs,
            "featuredProperties" => $featuredProperties
        ));
    }

    /**
     * Set up homepage for theme two.
     */
    protected function makeThemeTwo()
    {
        $blogs = \App\Blogs::take(3)->where("id_company", env("ID_COMPANY"))->get();
        $contact = \App\Classes\PresetSectionProvider::contactSection();
        $properties = \App\Properties::take(3)->get();
        $testimonials = \App\Classes\PresetSectionProvider::testimonialSlider();
        $blogs = \App\Classes\PresetSectionProvider::blogGrid();
        foreach ($properties as $row )
        {
            $row->images = [];
            $images = \App\PropertiesImages::where("id_property", $row->id)->get();
            foreach ($images as $image) {
                $image->route = env('GOOGLE_CLOUD_PUBLIC_ACCESS').$image->path;
                $row->images[] = $image;
            }
        }
        $this->cont->body = view("home/index", array(
            "contact" => $contact,
            "blog" => $blogs,
            "properties" => $properties,
            "blogs" => $blogs,
            "testimonials" => $testimonials
        ));        
    }

    public function submitPropertyModalAction() {
        return view("modal/submitproperty");
    }


    public function registerModalAction()
    {
        return view('modal/register');
    }

    public function registerAction()
    {
        $date = new \DateTime();
        $enq = \App\Enquiries::create( $_REQUEST );
        $enq->date_joined = $date->format('Y-m-d H:i:s');
        $enq->id_company = env("ID_COMPANY");
        $enq->save();
    
        $apt = ( isset( $_REQUEST['id_apartment'] ) && $_REQUEST['id_apartment'] != "" ) ? \App\Apartments::where('id', $_REQUEST['id_apartment'])->first() : null;

        $template = view('mail/enquiries', array(
            "enq" => $enq,
            "apt" => $apt
        ));
        
        \Mail::to ( self::ADMIN )->send( new \App\Mail\Enquiry( $enq, $apt ) );
        return \Redirect::to('/')->send();
    }
    
}