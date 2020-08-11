<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdministrationController as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use \App\Providers\TranslationProvider;
use Illuminate\Http\Request;

class PropertyInformationController extends BaseController
{
    public function __construct() {
        $this->secure = 1;
        parent::__construct();
        $this->user = \UserLogic::getUser();
    }

    public function downloadAction()
    {
        $id_property = $_REQUEST["id_property"];
        $property = \App\Properties::where("id", (int)$id_property)->first();
        header('Content-Disposition: attachment; filename="property_information_'.$property->id.'.csv";');
        if ( file_exists( "data/properties/$property->id/property_information.json" ) )
        {
            $csv = "";
            $file = \file_get_contents("data/properties/$property->id/property_information.json") ;
            $contents = \json_decode( $file );
            foreach ( $contents as $section )
            {
                $csv .= $section->name.";Notes;Yes;No\n";
                foreach ( $section->subsections as $subsection )
                {
                    $csv .= "$subsection->name;$subsection->value;";
                    if ( (int) $subsection->radio === 1 )
                    {
                        $csv .= ( (int)$subsection->radio_value === 1 ) ? "X;;" : ";X;";
                    }
                    $csv .= "\n";
                }
            }
            die( $csv );
        }
    }
    
    public function defaultAction() {
        if ( !isset( $_REQUEST["id_property"] ) || $_REQUEST["id_property"] == "" ) \Redirect::to("Admin") ->send();

        $id_property =  $_REQUEST["id_property"] ;
        
        $property = \App\Properties::where("id", (int)$id_property)->first();

        if ( file_exists( "data/properties/$property->id/property_information.json" ) )
        {
            $file = \file_get_contents("data/properties/$property->id/property_information.json") ;
            $contents = \json_decode( $file );
            $html = $this->fileExists( $contents );
        }
        else
        {
            $file =  \file_get_contents("data/property_information.json");
            $contents = \json_decode( $file );
            $html = $this->fileDoesntExist( $contents);
        }

        $this->cont->body = view("adminproperties/propertyinformation", array(
            "html" => $html,
            "property" => $property
        ));

        return $this->RenderView();

    }

    protected function fileExists( $contents )
    {
        $j = 0;
        $k = 1;
        $html = "";
        foreach ( $contents as $section )
        {
            $i = 0;
            foreach ( $section->subsections as $subsection )
            {
                if ( $i % 8 === 0 )
                {
                    $html .= '<div class="container-fluid" container-id="'.$j.'"><h5>'.$section->name.'</h5><div class="row">';
                }

                $html .= '<div class="col-12 col-xl-6">';
                $html .= '<label>'.$subsection->name."</label>";
                
                if ( array_key_exists("radio", $subsection) && (int)$subsection->radio === 1 )
                {
                    
                    $html .= '<div class="row">';
                    $html .=    '<div class="col-6">
                                    <div class="inputGroup">';

                    if ( property_exists($subsection , "radio_value" ) && (int)$subsection->radio_value === 1 )
                    {
                        $html .= '<input class="" type="radio" name="section-'.$k.'-radiosubsection-'.$i.'" id="section-'.$k.'-radiosubsection-'.$i.'1" value="1" checked>';
                    }
                    else
                    {
                        $html .= '<input class="" type="radio" name="section-'.$k.'-radiosubsection-'.$i.'" id="section-'.$k.'-radiosubsection-'.$i.'1" value="1">';                        
                    }

                    $html .= '<label class="" for="section-'.$k.'-radiosubsection-'.$i.'1">
                                        Yes
                                    </label>
                                </div></div>';
                    $html .=    '<div class="col-6">
                                    <div class="inputGroup">';
                    if ( property_exists($subsection , "radio_value" ) && (int)$subsection->radio_value === 1 )
                    {
                        $html .= '<input class="" type="radio" name="section-'.$k.'-radiosubsection-'.$i.'" id="section-'.$k.'-radiosubsection-'.$i.'2" value="0">';
                    }
                    elseif ( property_exists($subsection, "radio_value") && (int)$subsection->radio_value === 0 )
                    {
                        $html .= '<input class="" type="radio" name="section-'.$k.'-radiosubsection-'.$i.'" id="section-'.$k.'-radiosubsection-'.$i.'2" value="0" checked>';
                    }
                    else
                    {
                        $html .= '<input class="" type="radio" name="section-'.$k.'-radiosubsection-'.$i.'" id="section-'.$k.'-radiosubsection-'.$i.'2" value="0">';
                    }

                    $html .= '<label class="" for="section-'.$k.'-radiosubsection-'.$i.'2">
                                        No
                                    </label>
                                </div></div></div>';
                }
                $html .= "<input class='form-control' name='section-$k-subsection-$i' type='text' value='$subsection->value'>";                

                $html .= "</div>";

                if ( $i % 8 === 7 && $i != count($section->subsections) )
                {
                    $html .= '<div class="mt-2 w-100 d-inline-flex justify-content-between">
                                <div onclick="prev()" class="btn btn-warning">Previous</div>
                                <div onclick="submit()" class="btn btn-success">Submit</div>
                                <div onclick="next()" class="btn btn-primary">Next</div>
                            </div>';
                    $html .= '</div></div>';
                    $j++;
                }
                $i++;
            }
            $html .= '<div class="mt-2 w-100 d-inline-flex justify-content-between">
                        <div onclick="prev()" class="btn btn-warning">Previous</div>
                        <div onclick="submit()" class="btn btn-success">Submit</div>
                        <div onclick="next()" class="btn btn-primary">Next</div>
                    </div>';
            $html .= '</div></div>';
            $k++;
            $j++;
        }

        return $html;
    }

    protected function fileDoesntExist($contents)
    {
        
        $j = 0;
        $k = 1;
        $html = "";
        foreach ( $contents as $section )
        {
            $i = 0;
            foreach ( $section->subsections as $subsection )
            {
                if ( $i % 8 === 0 )
                {
                    $html .= '<div class="container-fluid" container-id="'.$j.'"><h5>'.$section->name.'</h5><div class="row">';
                }

                $html .= '<div class="col-12 col-xl-6">';
                $html .= '<label>'.$subsection->name."</label>";
                
                if ( array_key_exists("radio", $subsection) && (int)$subsection->radio === 1 )
                {
                    
                    $html .= '<div class="row">';
                    $html .=    '<div class="col-6">
                                    <div class="inputGroup">
                                    <input class="" type="radio" name="section-'.$k.'-radiosubsection-'.$i.'" id="section-'.$k.'-radiosubsection-'.$i.'1" value="1">
                                    <label class="" for="section-'.$k.'-radiosubsection-'.$i.'1">
                                        Yes
                                    </label>
                                </div></div>';
                    $html .=    '<div class="col-6">
                                    <div class="inputGroup">
                                    <input class="" type="radio" name="section-'.$k.'-radiosubsection-'.$i.'" id="section-'.$k.'-radiosubsection-'.$i.'2" value="0">
                                    <label class="" for="section-'.$k.'-radiosubsection-'.$i.'2">
                                        No
                                    </label>
                                </div></div></div>';
                }
                $html .= "<input class='form-control' name='section-$k-subsection-$i' type='text'>";                

                $html .= "</div>";

                if ( $i % 8 === 7 && $i != count($section->subsections) )
                {
                    $html .= '<div class="mt-2 w-100 d-inline-flex justify-content-between">
                                <div onclick="prev()" class="btn btn-warning">Previous</div>
                                <div onclick="submit()" class="btn btn-success">Submit</div>
                                <div onclick="next()" class="btn btn-primary">Next</div>
                            </div>';
                    $html .= '</div></div>';
                    $j++;
                }
                $i++;
            }
            $html .= '<div class="mt-2 w-100 d-inline-flex justify-content-between">
                        <div onclick="prev()" class="btn btn-warning">Previous</div>
                        <div onclick="submit()" class="btn btn-success">Submit</div>
                        <div onclick="next()" class="btn btn-primary">Next</div>
                    </div>';
            $html .= '</div></div>';
            $k++;
            $j++;
        }

        return $html;
    }

    public function saveDataAction()
    {
        $questions = 0;
        $answers = 0;
        $id = $_REQUEST["property_id"];
        $file = ( file_exists( "data/properties/$id/property_information.json" ) ) ? \file_get_contents("data/properties/$id/property_information.json") : \file_get_contents("data/property_information.json");
        $contents = \json_decode( $file );
        $j = 0;
        $k = 1;
        $html = "";
        foreach ( $contents as $section )
        {
            $i = 0;
            foreach ( $section->subsections as $subsection )
            {
                $questions++;
                $subsection->value = $_REQUEST["section-$k-subsection-$i"];
                
                if ( array_key_exists("radio", $subsection) && (int)$subsection->radio === 1 )
                {
                    if ( isset( $_REQUEST["section-$k-radiosubsection-$i"] ) ) $subsection->radio_value = $_REQUEST["section-$k-radiosubsection-$i"];
                }

                if ( array_key_exists("radio", $subsection) && (int)$subsection->radio === 1 )
                {
                    if ( isset( $_REQUEST["section-$k-radiosubsection-$i"] ) && $_REQUEST["section-$k-radiosubsection-$i"] != "" ) $answers++;
                }
                else
                {
                    if ( $_REQUEST["section-$k-subsection-$i"] != "" ) $answers++;
                }
                $i++;
            }
            $k++;
        }

        $pct = (int)(100*$answers/$questions);

        $property = \App\Properties::where("id", $id)->first();
        $property->information_complete = $pct;
        $property->save();
        if ( !\is_dir("data/properties/$id") ) mkdir("data/properties/$id", 0777, true);
        \file_put_contents("data/properties/$id/property_information.json", json_encode($contents));
        return "OK";
    }
}